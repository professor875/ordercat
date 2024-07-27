<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Contact;
use App\Models\Kitchen;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StageFactory extends Factory
{
    protected $model = Stage::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'delivery_at' => now()->subDays(mt_rand(1, 7)),
            'ordered_for_id' => Building::factory(),
            'ordered_from_id' => Kitchen::factory(),
            'created_by_id' => User::factory(),
            'created_at' => now()->subDays(mt_rand(1, 7)),
            'status' => $this->faker->randomElement(config('constants.stageStatuses'))
        ];
    }
}
