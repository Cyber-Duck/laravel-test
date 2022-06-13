<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SalesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_user_can_see_the_coffee_sales_page()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/sales')
            ->assertStatus(200)
            ->assertSee('Quantity');
    }
}
