<?php

use Faker\Generator as Faker;
use HamedSadeghi\ArticleManager\Models\Article;
use HamedSadeghi\ArticleManager\Models\User;

$factory->define(Article::class, function (Faker $faker) {
    $title = \Faker::sentence(10);
    $user = User::inRandomOrder()->get()->first();

    return array(
        'user_id' => $user->id,
        'title' => $title,
//        'slug' => Str::slug($title),
        'body' => \Faker::paragraph(5),
        'viewCount' => 0,
        'commentCount' => 0
    );
});
