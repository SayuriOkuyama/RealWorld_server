<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $users = User::factory(30)->create();
    Article::factory(100)->recycle($users)->create();

    Tag::factory(100)->create();

    ArticleTag::factory(200)->create();
  }
}
