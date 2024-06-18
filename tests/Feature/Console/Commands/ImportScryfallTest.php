<?php

use App\Console\Commands\ImportScryfall;
use App\Enums\Finishes;
use App\Enums\Franchises;
use App\Enums\Providers;
use App\Models\Product;
use App\Models\Release;
use Illuminate\Support\Facades\Http;
use function Pest\testDirectory;

it('can import scryfall products', function () {

    Http::preventStrayRequests();

    Http::fake([
        'https://api.scryfall.com/bulk-data' => Http::response([
           'data' => [
               [
                   'type' => 'default_cards',
                   'download_uri' => testDirectory('Data/default_cards.json')
               ],[
                   'type' => 'unique_artwork',
                   'download_uri' => testDirectory('Data/unique_artwork.json')
               ]
           ]
        ])
    ]);

    $this->artisan(ImportScryfall::class);

    $release = Release::where('external_id', '=', 'xxx1234')
        ->where('name', '=', 'Limited Edition Alpha')
        ->where('code', '=', 'lea')
        ->first();
    $this->assertNotNull($release);

    $product = Product::where('provider', '=', Providers::SCRYFALL)
        ->where('franchise', '=', Franchises::MAGIC)
        ->where('external_id', '=', 'aaa12345')
        ->with(['prices'])
        ->first();
    $this->assertEquals($release->id, $product->release_id);
    $this->assertEquals('en', $product->language);
    $this->assertEquals('Black Lotus', $product->name);
    $this->assertEquals('You win.', $product->description);

    $this->assertEquals(50, $product->prices->firstWhere('finish', '=', Finishes::NONFOIL)->price);
    $this->assertEquals(1_00, $product->prices->firstWhere('finish', '=', Finishes::FOIL)->price);
    $this->assertEquals(1_50, $product->prices->firstWhere('finish', '=', Finishes::ETCHED)->price);

    $release = Release::where('external_id', '=', 'yyyy1234')
        ->where('name', '=', 'Limited Edition Beta')
        ->where('code', '=', 'leb')
        ->first();
    $this->assertNotNull($release);

    $product = Product::where('provider', '=', Providers::SCRYFALL)
        ->where('franchise', '=', Franchises::MAGIC)
        ->where('external_id', '=', 'ggg12345')
        ->with(['prices'])
        ->first();
    $this->assertEquals($release->id, $product->release_id);
    $this->assertEquals('en', $product->language);
    $this->assertEquals('Black Lotus', $product->name);
    $this->assertEquals('You win.', $product->description);

    $this->assertEquals(500_00, $product->prices->firstWhere('finish', '=', Finishes::NONFOIL)->price);
    $this->assertEquals(1000_00, $product->prices->firstWhere('finish', '=', Finishes::FOIL)->price);
    $this->assertEquals(1500_00, $product->prices->firstWhere('finish', '=', Finishes::ETCHED)->price);

});

it('can update existing product prices', function () {

    Http::preventStrayRequests();

    Http::fake([
        'https://api.scryfall.com/bulk-data' => Http::response([
           'data' => [
               [
                   'type' => 'default_cards',
                   'download_uri' => testDirectory('Data/default_cards.json')
               ],[
                   'type' => 'unique_artwork',
                   'download_uri' => testDirectory('Data/unique_artwork.json')
               ]
           ]
        ])
    ]);

    $product = Product::factory()->create([
       'external_id' => 'aaa12345',
       'provider' => Providers::SCRYFALL,
       'franchise' => Franchises::MAGIC,
    ]);

    $this->artisan(ImportScryfall::class);

    $product->load('prices');

    $this->assertEquals(50, $product->prices->firstWhere('finish', '=', Finishes::NONFOIL)->price);
    $this->assertEquals(1_00, $product->prices->firstWhere('finish', '=', Finishes::FOIL)->price);
    $this->assertEquals(1_50, $product->prices->firstWhere('finish', '=', Finishes::ETCHED)->price);

});

it('can reuse known releases', function () {

    Http::preventStrayRequests();

    Http::fake([
        'https://api.scryfall.com/bulk-data' => Http::response([
           'data' => [
               [
                   'type' => 'default_cards',
                   'download_uri' => testDirectory('Data/default_cards.json')
               ],[
                   'type' => 'unique_artwork',
                   'download_uri' => testDirectory('Data/unique_artwork.json')
               ]
           ]
        ])
    ]);

    $release = Release::factory()->create([
       'external_id' => 'xxx1234',
       'code' => 'lea',
       'name' => 'Limited Edition Alpha',
    ]);

    $this->artisan(ImportScryfall::class);

    $product = Product::where('external_id', '=', 'aaa12345')->first();
    $this->assertEquals($release->id, $product->release_id);

});

it('will ignore nonenglish cards', function () {

    Http::preventStrayRequests();

    Http::fake([
        'https://api.scryfall.com/bulk-data' => Http::response([
           'data' => [
               [
                   'type' => 'default_cards',
                   'download_uri' => testDirectory('Data/default_cards.json')
               ],[
                   'type' => 'unique_artwork',
                   'download_uri' => testDirectory('Data/unique_artwork.json')
               ]
           ]
        ])
    ]);

    $this->artisan(ImportScryfall::class);

    $this->assertNull(Product::where('external_id', '=', 'ccc12345')->first());
    $this->assertNull(Release::where('external_id', '=', 'zzz1234')->first());

});
