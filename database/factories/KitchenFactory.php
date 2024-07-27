<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

use App\Models\User;

class KitchenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'commercial_registration' => $this->faker->word(),
            'location_coordinate' => $this->faker->word(),

            'user_id'=>User::factory(),

        ];
    }
}
