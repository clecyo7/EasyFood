<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
      /**
     * Handle the Tenant "creating" event.
     *
     * @param  \App\Models\Models\\Tenant  $tenant
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
    }
}
