<?php

use HamedSadeghi\ArticleManager\Models\Category;

$factory->define(Category::class, function () {
    $title = \Faker::word(5);

    return [
        'title' => $title,
//        'slug' => \Illuminate\Support\Str::slug($title),
    ];
});
