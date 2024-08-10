<?php

// database/factories/RoomFactory.php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'floor_number' => $this->faker->numberBetween(1, 10),
            'room_number' => $this->faker->unique()->numberBetween(100, 999),
            'capacity' => $this->faker->numberBetween(1, 4),
            'status' => $this->faker->randomElement(['READY', 'TAKEN', 'MAINTENANCE']),
        ];
    }
}
