<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderFactory extends Factory
{

    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Customer::inRandomOrder()->first(),
            'total_price' => $this->faker->randomFloat(2, 200, 2000),
            'status' => 'pending',
            'note' => $this->faker->sentence,
        ];
    }

}
