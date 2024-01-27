<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleTag>
 */
class ArticleTagFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $articleIDs  = Article::pluck('id')->all();
    $tagIDs  = Tag::pluck('id')->all();

    return [
      'article_id' => fake()->randomElement($articleIDs),
      'tag_id' => fake()->randomElement($tagIDs)
    ];
  }
}
