<?php 

namespace App\Models\Traits;

trait UserACLTrait {

    public function permissions() {
       $tenant = $this->tenant()->first();
       $plan = $tenant->plan;

//eturn $plan->profiles;


;       $permissions = [];
       foreach($plan->profiles as $profile) {
            foreach($profile->permissions as $permission) {
                array_push($permissions, $permission);
            }
       }
       return $permissions;
    }
    
}