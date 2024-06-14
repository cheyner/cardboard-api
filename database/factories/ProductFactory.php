<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Categories;
use App\Enums\Franchises;
use App\Models\Product;
use App\Models\Release;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ProductFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Product::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'external_id' => $this->faker->uuid(),
            'image_path' => $this->faker->imageUrl(),
            'category' => Categories::CARD,
            'franchise' => Franchises::MAGIC,
            'release_id' => Release::factory(),
        ];
    }
}
