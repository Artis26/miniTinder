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
class UserProfileFactory extends Factory
{
    private static $userId = 1;

    public function definition()
    {
        $firstName = $this->faker->firstName;

            return [
                'user_id' => self::$userId++,
                'name' => $firstName,
                'surname' => $this->faker->lastName,
                'gender' => substr($firstName, -1) ? 'Male' : 'Female',  //$this->faker->randomElements(['Male', 'Female'])[0],
                'age' => $this->faker->numberBetween(18, 35),
                'country' => 'Latvia',
                'city' => $this->faker->city,
                'profile_picture' => 'default/no-user-image-icon-27.jpg',
                'description' => 'I am faker.'
            ];
        }
}
