<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;


use Tests\TestCase;

class TenantTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test Get all Tenants.
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        Tenant::factory()->count(10)->create();
        $response = $this->getJson('/api/v1/tenants');

        $response->assertStatus(200);
    }
}
