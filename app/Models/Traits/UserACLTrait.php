<?php

namespace App\Models\Traits;

trait UserACLTrait
{

    public function permissions()
    {

        // puxa os relacionamentos até chegar nas permissions 
        $tenant = $this->tenant;
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }
        return $permissions;
    }

    // verifica se o usuario logado tem permissão
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }

    // verifica se o email logado é super adm
    public function isAdmin(): bool
    {
        return in_array($this->email, config('acl.admins'));
    }

    public function isTenant(): bool
    {
        return !in_array($this->email, config('acl.admins'));
    }
}
