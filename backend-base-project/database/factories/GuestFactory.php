<?php

// database/factories/GuestFactory.php

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'age' => $this->faker->numberBetween(18, 99),
        ];
    }
}
