<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name'=> 'plans',
                'description' => 'Perfil para modulo de Planos'
            ],
            [
                'name'=> 'profiles',
                'description' => 'Perfil para modulo de Perfil'
            ],
            [
                'name'=> 'permissions',
                'description' => 'Perfil para modulo de Permissões'
            ],
            [
                'name'=> 'users',
                'description' => 'Perfil para modulo de Usuários'
            ],
            [
                'name'=> 'categories',
                'description' => 'Perfil para modulo de Categorias'
            ],
            [
                'name'=> 'products',
                'description' => 'Perfil para modulo de Produtos'
            ],
            [
                'name'=> 'tenants',
                'description' => 'Perfil para modulo de Empresas'
            ],
            [
                'name'=> 'tables',
                'description' => 'Perfil para modulo de Mesa'
            ],
        ];

        foreach($permissions as $permission) {
            Permission::create($permission);
        }



         //m  tenants plans profiles permissions users categories products tables

    }
}
