<?php

namespace Database\Factories;

use App\Enums\BuildingTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

class BuildingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'type' => $this->faker->randomElement(BuildingTypeEnum::cases()),
            'number' => $this->faker->randomNumber(),
            'inhabitants_count' => $this->faker->word(),
            'location_coordinate' => $this->faker->word(),
            'user_id' => User::factory(),
        ];
    }
}
