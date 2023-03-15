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
            'cnpj' => '2388270600120',
            'name' => 'C7Tech',
            'url'  => 'c7tech',
            'email' => 'admin@c7tech.com',
        ]);
    }
}
