<?php

Route::group([
    'namespace' => 'HamedSadeghi\ArticleManager\Http\Controllers',
    'prefix' => 'admin',
    'middleware' => ['web', 'auth', 'flash_message']
], function(){
    Route::name('admin.articles')->get('/articles', 'ArticleController@index');
    Route::name('admin.article.form')->get('/article/form/{article_id?}', 'ArticleController@form');
    Route::name('admin.article.store')->post('/article/store', 'ArticleController@store');
    Route::name('admin.article.update')->patch('/article/store/{article_id}', 'ArticleController@store');
    Route::name('admin.article.delete')->get('/article/delete/{article_id}', 'ArticleController@delete');
});

Route::group([
    'namespace' => 'HamedSadeghi\ArticleManager\Http\Controllers',
    'middleware' => ['web']
], function(){
    Route::name('articles')->get('/articles', 'ArticleController@blog');
    Route::name('article.view')->get('/article/{article}', 'ArticleController@view');

    Route::name('comment.store')->post('/article/{article}/comments/store', 'CommentController@store')->middleware('auth');

    Route::name('category.view')->get('/articles/category/{category}', 'CategoryController@view');
});