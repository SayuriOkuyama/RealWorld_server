<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'title' => fake()->realText(random_int(30, 100)),
      'about' => fake()->realText(random_int(50, 200)),
      'content' => fake()->realText(random_int(200, 800)),
      'user_id' => User::factory()
    ];
  }
}
