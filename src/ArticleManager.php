<?php
namespace HamedSadeghi\ArticleManager;

use HamedSadeghi\ArticleManager\Models\Category;

class ArticleManager
{
    public function categories(){
        $categories = Category::all();
        return $categories;
    }
}