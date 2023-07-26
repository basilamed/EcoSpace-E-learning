<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'contact' => $this->faker->phoneNumber,
            'birthPlace' => $this->faker->city,
            'birthCountry' => $this->faker->country,
            'birthDate' => $this->faker->date,
            'jmbg' => $this->faker->numerify('#############'),
            'role' => $this->faker->randomElement(['admin', 'student', 'teacher']),
            'picture' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail(),
            'approved' => $this->faker->boolean,
            'email_verified_at' => now()
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
