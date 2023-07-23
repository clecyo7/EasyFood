<?php

namespace Tests\Feature\Api;

use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Evaluationtest extends TestCase
{
    /**
     * Test Error Create New Evaluation
     *
     * @return void
     */
    public function testErrorCreateNewEvaluation()
    {
        $order = 'fake_value';

        $response = $this->postJson("/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(404);
    }


    /**
     * Test Create New Evaluation
     *
     * @return void
     */


    public function testCreateNewEvaluation()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = $client->orders()->save(factory(Order::class)->make());

        $payload = [
            'stars' => 5,
            'comment' => Str::random(10), // Generating a random comment
        ];

        $response = $this->postJson(
            "/api/auth/v1/orders/{$order->identify}/evaluations",
            $payload,
            [
                'Authorization' => "Bearer {$token}",
            ]
        );

        $response->assertStatus(201);
    }
}
