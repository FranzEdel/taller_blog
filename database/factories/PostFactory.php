<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);
        return [
            'user_id' => rand(1,30),
            'category_id' => rand(1,20),
            'name' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->text(200),
            'body' => $this->faker->text(500),
            'published_at' => $this->faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = null),
            'foto' => $this->faker->imageUrl($width = 750, $height = 350),
            'status' => $this->faker->randomElement($array = array('DRAFT','PUBLISHED')),
        ];
    }
}
