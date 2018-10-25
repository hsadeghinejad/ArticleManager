<?php

use Faker\Generator as Faker;
use HamedSadeghi\ArticleManager\Models\Comment;
use HamedSadeghi\ArticleManager\Models\User;

$factory->define(Comment::class, function (Faker $faker) {
    $user = User::inRandomOrder()->get()->first();

    return [
        'user_id' => $user->id,
        'body' => \Faker::paragraph(2),
    ];
});
