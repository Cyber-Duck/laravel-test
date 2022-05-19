<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateShipmentCostsTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->be($this->user);
    }

    public function test_200_response_with_valid_params()
    {
        $this->post(
            "/shipping-partners",
            ['cost' => 5.00],
            ['Accept' => 'application/json']
        )->assertStatus(302);
    }

    public function test_422_response_for_invalid_shipment_cost()
    {
        $this->post(
            "/shipping-partners",
            ['cost' => -0.001],
            ['Accept' => 'application/json']
        )->assertStatus(422);
    }
}
