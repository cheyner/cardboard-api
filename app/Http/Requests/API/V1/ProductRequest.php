<?php

declare(strict_types=1);

namespace App\Http\Requests\API\V1;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

final class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', Product::class);
    }

    public function rules(): array
    {
        return [
        ];
    }
}
