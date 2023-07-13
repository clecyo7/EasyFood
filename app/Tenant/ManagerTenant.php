<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        return auth()->check() ? auth()->user()->tenant_id : '';
    }

    public function getTenant(): Tenant
    {
        return auth()->check() ? auth()->user()->tenant : '';
    }

    /**
     * Verifica se o user está incluido no array de admin
     */
    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('tenant.admin'));
    }
}
