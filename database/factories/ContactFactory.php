<?php

namespace Database\Factories;

use App\Enums\ContactChannelEnum;
use App\Enums\ContactTypeEnum;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(ContactTypeEnum::cases()),
            'contact_channel' => $this->faker->randomElement(ContactChannelEnum::class),
            'sms' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'whatsapp' => $this->faker->phoneNumber(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
