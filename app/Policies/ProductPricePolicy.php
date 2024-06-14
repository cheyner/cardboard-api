<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ProductPrice;
use App\Models\User;

class ProductPricePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductPrice $productPrice): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, ProductPrice $productPrice): bool
    {
        return false;
    }

    public function delete(User $user, ProductPrice $productPrice): bool
    {
        return false;
    }

    public function restore(User $user, ProductPrice $productPrice): bool
    {
        return false;
    }

    public function forceDelete(User $user, ProductPrice $productPrice): bool
    {
        return false;
    }
}
