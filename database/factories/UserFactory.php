<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $providers = ['google', 'facebook', 'local']; // Cho thêm null để giả lập trường hợp không dùng social login
        $provider = $this->faker->randomElement($providers);

        return [
            'fullname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'phone' => $this->faker->phoneNumber,
            'dob' => $this->faker->date('Y-m-d', '2006-01-01'),
            'rank' => $this->faker->randomElement(['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond']),
            'avatar' => 'frontend/images/avatar/avatar_' . $this->faker->numberBetween(1, 50) . '.jpg',
            'role_id' => \App\Models\Role::inRandomOrder()->value('id'),
            'ward_id' => \App\Models\Ward::inRandomOrder()->value('id'),
            'provider' => $provider,
            'gender' => $this->faker->randomElement(['Male','Female']),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
