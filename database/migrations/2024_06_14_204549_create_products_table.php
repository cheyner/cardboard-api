<?php

declare(strict_types=1);

use App\Enums\Categories;
use App\Enums\Franchises;
use App\Enums\Providers;
use App\Models\Release;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up(): void
    {
        Schema::create('products', static function (Blueprint $table): void {
            $table->id();
            $table->uuid()->nullable()->index();

            $table->string('name')->index();
            $table->string('category')->default(Categories::CARD->value);
            $table->string('franchise')->default(Franchises::MAGIC->value);
            $table->string('provider')->default(Providers::SCRYFALL->value);
            $table->text('description')->nullable();
            $table->text('external_id')->nullable();
            $table->text('image_path')->nullable();

            $table->foreignIdFor(Release::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
