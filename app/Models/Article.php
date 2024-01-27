<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  use HasFactory;

  /*
  * 複数挿入可能な属性を指定
  */
  protected $fillable = [
    'title',
    'about',
    'content',
    'user_id'
  ];

  /*
  * 記事に紐づくユーザーを取得
  */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /*
  * 記事に紐づくタグを取得
  */
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }
}
