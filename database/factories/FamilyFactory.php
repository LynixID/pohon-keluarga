<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    protected $model = Family::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'family_name' => $this->faker->unique()->lastName . ' Family',
            'description' => $this->faker->sentence,
        ];
    }
}
