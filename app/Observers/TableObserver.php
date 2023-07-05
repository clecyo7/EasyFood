<?php

namespace App\Observers;

use App\Models\Table;
use Illuminate\Support\Str;

class TableObserver
{
    /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function creating(Table $table)
    {
        $table->uuid = Str::uuid();
    }

}
