<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filter>
 */
class FilterFactory extends Factory
{
    private static $userId = 1;

    public function definition()
    {
        return [
             'user_id' => self::$userId++,
             'min_age' => 18,
             'max_age' => 119,
             'gender' => 'Female',
             'country' => 'Latvia',
             'city' => 'Riga'
        ];
    }
}
