<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
class MovieFactory extends Factory
{
    protected $model = Movie::class;
    public function definition()
    {
        return [
            'status' => true,
            'title_uk' => $this->faker->sentence(3),
            'title_en' => $this->faker->sentence(3),
            'description_uk' => $this->faker->paragraph,
            'description_en' => $this->faker->paragraph,
            'poster' => null,
            'screenshots' => null,
            'youtube_trailer_id' => null,
            'release_year' => $this->faker->year,
            'start_date' => null,
            'end_date' => null,
        ];
    }
}
