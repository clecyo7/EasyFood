<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    private $plan, $data = [];

    public function make(Plan $plan, Request $request)
    {
        $this->plan = $plan;
        $this->data = $request;

        $tenant = $this->storeTenant();

        $user = $this->storeUser($tenant);

        return $user;
    }


    public function storeTenant()
    {
        $data = $this->data;

        return $this->plan->tenants()->create([
            'cnpj'  => $data['cnpj'],
            'name'  => $data['empresa'],
            'url'   => Str::kebab($data['empresa']),
            'email' => $data['email'],

            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
    }


    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name'  => $this->data['name'],
            'email' => $this->data['email'],
            'password' => Hash::make($this->data['password']),
        ]);

        return $user;
    }
}
