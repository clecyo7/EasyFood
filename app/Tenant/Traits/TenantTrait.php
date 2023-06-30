<?php

namespace App\Tenant\Traits;

use App\Tenant\Observer\TenantObserver;
use App\Tenant\Scopes\TenantScope;

trait TenantTrait {

        /**
     * The "booted" method of the model.
     * chamando o observer para criar tenant_id de forma automática
     * @return void
     */
    protected static function booted()
    {
        static::observe(TenantObserver::class);
        static::addGlobalScope(new TenantScope);
    }
}
