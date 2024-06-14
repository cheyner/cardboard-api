<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Finishes;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ProductPrice extends Model
{
    use HasFactory;
    use HasTimestamps;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'finish',
        'price',
    ];

    /** @return array<string,string> */
    protected function casts(): array
    {
        return [
            'finish' => Finishes::class,
            'price' => 'integer',
        ];
    }

    /** @return BelongsTo<Product> */
    public function product(): BelongsTo
    {
        return $this->belongsTo(
            related: Product::class,
            foreignKey: 'product_id',
        );
    }

    public function scopeMostRecentForFinish($query, Product $product, Finishes $finish): void
    {
        $query->where('product_id', $product->id)
            ->where('finish', $finish)
            ->orderByDesc('created_at')
            ->limit(1);
    }
}
