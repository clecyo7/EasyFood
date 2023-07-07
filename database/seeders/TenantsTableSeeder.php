<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23882706001200',
            'name' => 'C7Tech',
            'url'  => 'c7tech',
            'email' => 'admin@c7tech.com',
            'active' => 'Y',
            'subscription' => '2023-07-07',
            'expires_at' => '2024-07-07',
            'subscription_id' => 'teste',
            'subscription_active' => 1,
            'subscription_suspended' => 0,

        ]);
    }
}
