<?php

namespace Database\Factories;

use App\Models\Petition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'petition_id' => Petition::factory(),
            'amount' => $this->faker->randomFloat(2, 5, 250),
            'payment_method' => $this->faker->randomElement(['paypal', 'credit_card', 'bank_transfer']),
        ];
    }
}
