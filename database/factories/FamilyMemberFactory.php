<?php

namespace Database\Factories;

use App\Models\FamilyMember;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyMemberFactory extends Factory
{
    protected $model = FamilyMember::class;

    public function definition()
    {
        return [
            'family_id' => Family::factory(),
            'name' => $this->faker->name,
            'relation' => $this->faker->randomElement(['Ayah', 'Ibu', 'Anak', 'Istri', 'Suami']),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'birth_date' => $this->faker->date(),
        ];
    }
}
