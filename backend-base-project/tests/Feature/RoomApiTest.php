<?php

// tests/Feature/RoomApiTest.php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_rooms()
    {
        $room = Room::factory()->create();

        $response = $this->getJson('/api/rooms');

        $response->assertStatus(200)
            ->assertJsonFragment(['room_number' => $room->room_number]);
    }

    /** @test */
    public function it_can_create_a_room()
    {
        $data = [
            'floor_number' => 2,
            'room_number' => 202,
            'capacity' => 3,
            'status' => 'MAINTENANCE',
        ];

        $response = $this->postJson('/api/rooms', $data);

        $response->assertStatus(201)
            ->assertJson($data);
    }

    /** @test */
    public function it_can_update_a_room()
    {
        $room = Room::factory()->create();

        $data = [
            'floor_number' => 3,
            'room_number' => 303,
            'capacity' => 4,
            'status' => 'READY',
        ];

        $response = $this->putJson("/api/rooms/{$room->id}", $data);

        $response->assertStatus(200)
            ->assertJson($data);
    }

    /** @test */
    public function it_can_delete_a_room()
    {
        $room = Room::factory()->create();

        $response = $this->deleteJson("/api/rooms/{$room->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);
    }

    /** @test */
    public function it_can_set_room_as_ready()
    {
        $room = Room::factory()->create(['status' => 'MAINTENANCE']);

        $response = $this->postJson("/api/rooms/{$room->id}/set-as-ready");

        $response->assertStatus(200)
            ->assertJson(['status' => 'READY']);
    }
}
