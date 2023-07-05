<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function creating(Product $product)
    {

        $product->flag = Str::kebab($product->title);
        $product->uuid = Str::uuid();
    }

    /**
     * Handle the Tenant "updating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}
