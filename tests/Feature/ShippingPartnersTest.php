<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingPartnersTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_see_the_shipping_partners_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/shipping-partners')
            ->assertStatus(200)
            ->assertSee('New cost of shipment');
    }
}
