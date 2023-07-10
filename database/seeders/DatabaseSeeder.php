<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PlansTableSeeder::class,
            TenantsTableSeeder::class,
            UsersTableSeeder::class,
            PermissionTableSeeder::class,
            RolesTableSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
