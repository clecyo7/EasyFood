<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plan_id' => Plan::factory(),
            'cnpj' => uniqid() . date('YmdHis'),
            'name' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}




