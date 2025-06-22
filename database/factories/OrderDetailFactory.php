<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class OrderDetailFactory extends Factory
{
    public function definition(): array
    {
        $itemType = $this->faker->randomElement(['tour', 'package']);

        if ($itemType == 'tour') {
            $item = \App\Models\Tour::inRandomOrder()->first();
        } else {
            $item = \App\Models\Package::inRandomOrder()->first();
        }

        return [
            'order_id' => \App\Models\Order::inRandomOrder()->first()->id,
            'item_id' => $item->id,
            'item_type' => $itemType,
            'quantity' => rand(1, 5),
            'unit_price' => $this->faker->randomFloat(2, 100, 500),
            'subtotal' => $this->faker->randomFloat(2, 100, 500),
            'discount_id' => null,
        ];
    }
}

