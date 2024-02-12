<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::prefix('articles')
  ->name('articles.')
  ->controller(ArticleController::class)
  ->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'get')->name('get');
    Route::post('/', 'create')->name('create');
    Route::put('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'delete')->name('delete');
  });
