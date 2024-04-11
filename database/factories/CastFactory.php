<?php

namespace Database\Factories;

use App\Models\Cast;
use Illuminate\Database\Eloquent\Factories\Factory;
class CastFactory extends Factory
{
    protected $model = Cast::class;

    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(['director', 'writer', 'actor', 'composer']),
            'name_uk' => $this->faker->name,
            'name_en' => $this->faker->name,
            'photo' => null,
        ];
    }
}
