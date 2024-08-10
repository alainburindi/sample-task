<?php

// tests/Feature/GuestApiTest.php

namespace Tests\Feature;

use App\Models\Guest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_guests()
    {
        $guest = Guest::factory()->create();

        $response = $this->getJson('/api/guests');

        $response->assertStatus(200)
            ->assertJsonFragment(['full_name' => $guest->full_name]);
    }

    /** @test */
    public function it_can_create_a_guest()
    {
        $data = [
            'full_name' => 'Jane Doe',
            'age' => 25,
        ];

        $response = $this->postJson('/api/guests', $data);

        $response->assertStatus(201)
            ->assertJson($data);
    }

    /** @test */
    public function it_can_update_a_guest()
    {
        $guest = Guest::factory()->create();

        $data = [
            'full_name' => 'John Doe',
            'age' => 30,
        ];

        $response = $this->putJson("/api/guests/{$guest->id}", $data);

        $response->assertStatus(200)
            ->assertJson($data);
    }

    /** @test */
    public function it_can_delete_a_guest()
    {
        $guest = Guest::factory()->create();

        $response = $this->deleteJson("/api/guests/{$guest->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('guests', ['id' => $guest->id]);
    }
}
