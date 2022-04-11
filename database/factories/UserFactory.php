<?php

namespace Database\Factories;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use App\Models\UserProfile;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */

class UserFactory extends Factory
{
    public function definition() {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('12345678'),
            'birthday' => $this->faker->dateTimeBetween('1990-01-01', '2002-12-31')
                ->format('Y/m/d')
        ];
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
