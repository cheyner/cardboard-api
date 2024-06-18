<?php

namespace App\Console\Commands;

use App\Enums\Categories;
use App\Enums\Finishes;
use App\Enums\Franchises;
use App\Enums\Providers;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Release;
use Brick\Money\Money;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use JsonMachine\Items;
use Symfony\Component\Console\Attribute\AsCommand;

use function Laravel\Prompts\info;

#[AsCommand(name: 'import:scryfall', description: 'Import All Cards & Prices from Scryfall.')]
class ImportScryfall extends Command
{

    public \Illuminate\Database\Eloquent\Collection $known_releases;

    public function handle()
    {

        $this->known_releases = Release::all();

        info('Beginning import process from Scryfall');

        info('Getting bulk data objects');
        $bulks = Http::get('https://api.scryfall.com/bulk-data')->json();

        info('Fetching all cards link');

        $defaultLink = collect($bulks['data'])->filter(fn ($item) => $item['type'] == 'default_cards')?->first()['download_uri'];

        $uniqueLink = collect($bulks['data'])->filter(fn ($item) => $item['type'] == 'unique_artwork')?->first()['download_uri'];

        info('Reading default cards from stream');

        $defaultCards = Items::fromFile($defaultLink);

        foreach ($defaultCards as $id => $card) {

            $this->createProduct(
                card: $card,
                franchise: Franchises::MAGIC,
                category: Categories::CARD,
                provider: Providers::SCRYFALL
            );

        }

        $uniqueCards = Items::fromFile($uniqueLink);

        foreach ($uniqueCards as $id => $card) {

            $this->createProduct(
                card: $card,
                franchise: Franchises::MAGIC,
                category: Categories::CARD,
                provider: Providers::SCRYFALL
            );

        }
    }

    public function createProduct(object $card, Franchises $franchise, Categories $category, Providers $provider): void
    {
        if ($card->lang !== 'en') {
            return;
        }

        $product = Product::where('external_id', $card->id)
            ->where('provider', $provider)
            ->where('franchise', $franchise)
            ->withTrashed()
            ->first();

        if ($product) {

            info("Product {$card->name} already exists");

        } else {

            info("Creating Product for {$card->name} {$card->set}");

            $release = $this->known_releases->where('name', $card->set_name)->where('code', $card->set)->first() ?? null;
            if (!$release) {
                info("Creating release for {$card->set_name} ({$card->set})");
                $release = Release::create(
                    [
                        'code' => $card->set,
                        'name' => $card->set_name,
                        'external_id' => $card->set_id,
                    ]
                );
                $this->known_releases->push($release);
            }

            $product = Product::create([
                'franchise' => $franchise,
                'category' => $category,
                'provider' => $provider,
                'release_id' => $release?->id ?? null,
                'external_id' => $card->id,
                'name' => $card->name ?? null,
                'description' => $card->oracle_text ?? null,
                'language' => $card->lang ?? null,
            ]);

            if (! $product) {
                $this->error('Could not create product');

                return;
            }

        }

        $this->createProductPrice(price: $card->prices->usd_foil, product: $product, finish: Finishes::FOIL);

        $this->createProductPrice(price: $card->prices->usd, product: $product, finish: Finishes::NONFOIL);

        $this->createProductPrice(price: $card->prices->usd_etched, product: $product, finish: Finishes::ETCHED);

        $this->importImage($product, $card);

    }

    private function createProductPrice($price, Product $product, Finishes $finish)
    {
        $amount = self::convertToSmallestUnit($price);

        if (blank($amount)) {
            return;
        }

        ProductPrice::create([
            'price' => $amount,
            'product_id' => $product->id,
            'finish' => $finish,
        ]);
    }

    private function importImage(Product $product, $card)
    {
        //TODO

    }

    public static function convertToSmallestUnit($amount, $currencyCode = 'USD'): ?int
    {
        if (blank($amount)) {
            return null;
        }

        $money = Money::of($amount, $currencyCode);

        $amountInSmallestUnit = $money->getMinorAmount()->toInt();

        return $amountInSmallestUnit;
    }
}
