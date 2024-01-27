<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\StoreApiArticleRequest;
use App\Http\Requests\UpdateApiArticleRequest;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $articles = Article::with('tags')->orderBy('updated_at', 'desc')->paginate(20);
    return response()->json($articles, 200);
  }

  public function get(string $id)
  {
    $article = Article::find($id);

    if ($article === null) {
      $res = response()->json(
        [
          'errors' => '投稿が見つかりませんでした',
        ],
        404
      );
      throw new HttpResponseException($res);
    }

    $article_tags = ArticleTag::where('article_id', $article->id)->get();

    $tag_names = [];
    if ($article_tags !== null) {
      foreach ($article_tags as $article_tag) {
        $tags = Tag::find($article_tag->tag_id);
        $tag_names[] = $tags->name;
      }
    }

    $data = [
      'id' => $article->id,
      'title' => $article->title,
      'about' => $article->about,
      'content' => $article->content,
      'tagList' => $tag_names
    ];

    return response()->json($data, 200);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(StoreApiArticleRequest $request)
  {
    $article = Article::create([
      'title' => $request['article']['title'],
      'about' => $request['article']['description'],
      'content' => $request['article']['body'],
      'user_id' => 1
    ]);

    $tags = $request['article']['tagList'];

    $tag_names = [];
    foreach ($tags as $tag) {
      if ($tag !== null) {
        $tag_data = Tag::firstOrCreate(['name' => $tag]);
        $tag_names[] = $tag_data->name;
        ArticleTag::create([
          'article_id' => $article->id,
          'tag_id' => $tag_data->id
        ]);
      }
    }

    $data = [
      "id" => $article->id,
      "title" => $article->title,
      "description" => $article->about,
      "body" => $article->content,
      "tagList" => $tag_names
    ];

    return response()->json($data, 201);
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateApiArticleRequest $request, string $id)
  {
    $article = Article::find($id);

    if ($article === null) {
      $res = response()->json(
        [
          'errors' => '投稿が見つかりませんでした',
        ],
        404
      );
      throw new HttpResponseException($res);
    }

    $data = [];
    if (array_key_exists('title', $request['article'])) {
      $title = $request['article']['title'];

      if (array_key_exists('description', $request['article'])) {
        $about = $request['article']['description'];
      } else {
        $about = $article->about;
      }
      if (array_key_exists('body', $request['article'])) {
        $content = $request['article']['body'];
      } else {
        $content = $article->content;
      }

      $new_article = Article::create([
        'title' => $title,
        'about' => $about,
        'content' => $content,
        'user_id' => 1
      ]);
      $article->delete();

      $data = [
        "id" => $new_article->id,
        "title" => $new_article->title,
        "description" => $new_article->about,
        "body" => $new_article->content
      ];
    } else {
      if (array_key_exists('description', $request['article'])) {
        $about = $request['article']['description'];
      } else {
        $about = $article->about;
      }
      if (array_key_exists('body', $request['article'])) {
        $content = $request['article']['body'];
      } else {
        $content = $article->content;
      }

      $new_article = Article::find($id);
      $new_article->title = $article->title;
      $new_article->about = $about;
      $new_article->content = $content;
      $new_article->save();

      $article_tags = ArticleTag::where(['article_id' => $id])->get();
      $tag_names = [];

      foreach ($article_tags as $article_tag) {
        if ($article_tag !== null) {
          $tag_data = Tag::where('tag_id', $article_tag->tag_id);
          $tag_names[] = $tag_data->name;
        }
      }

      $data = [
        "id" => $new_article->id,
        "title" => $new_article->title,
        "description" => $new_article->about,
        "body" => $new_article->content,
        "tagList" => $tag_names
      ];
    }

    return response()->json($data, 201);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function delete(string $id)
  {
    $article = Article::find($id);

    if ($article === null) {
      $res = response()->json(
        [
          'errors' => '投稿が見つかりませんでした',
        ],
        404
      );
      throw new HttpResponseException($res);
    }

    $article_tags = ArticleTag::where(['article_id' => $id]);
    $article_tags_data = $article_tags->get();

    if ($article_tags_data !== null) {
      foreach ($article_tags_data as $article_tag_data) {
        $tag_id = $article_tag_data->tag_id;
        $existing_article_tags = ArticleTag::where(['tag_id' => $tag_id])->get();

        if (count($existing_article_tags) === 1) {
          Tag::where('id', $tag_id)->delete();
        }
      }
      $article_tags->delete();
    }

    $article->delete();

    $data = [
      'message' => '削除されました'
    ];

    return response()->json($data, 200);
  }
}
