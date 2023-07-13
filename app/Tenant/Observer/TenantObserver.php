<?php

namespace App\Tenant\Observer;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;


class TenantObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  Illuminate\Database\Eloquent\Model $model;
     * @return void
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);
        $dentify = $managerTenant->getTenantIdentify();

        if ($dentify)
            $model->tenant_id = $dentify;
    }
}
