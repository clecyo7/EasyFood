<?php

namespace App\Observers;

use App\Models\Products;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function creating(Products $product)
    {

        $product->flag = Str::kebab($product->title);
    }

    /**
     * Handle the Tenant "updating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function updating(Products $product)
    {
        $product->flag = Str::kebab($product->title);
    }
}
