<?php

namespace App\Models\Traits;

trait UserACLTrait {

    public function permissions() {

       $tenant = $this->tenant;
        $plan = $tenant->plan;

      $permissions = [];
       foreach($plan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }

       }
       return $permissions;
    }

}
