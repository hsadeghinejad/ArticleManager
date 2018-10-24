<?php

use Faker\Generator as Faker;
use HamedSadeghi\ArticleManager\Models\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'body' => \Faker::paragraph(2),
    ];
});
