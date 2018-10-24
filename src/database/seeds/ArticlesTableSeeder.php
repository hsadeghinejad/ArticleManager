<?php
namespace HamedSadeghi\ArticleManager\database\seeds;

use HamedSadeghi\ArticleManager\Models\Article;
use HamedSadeghi\ArticleManager\Models\Category;
use HamedSadeghi\ArticleManager\Models\Comment;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create();

        factory(Article::class, 50)->create()->each(function(Article $article){
            for ($i=1 ; $i<=rand(1,5) ; $i++) {
                $category_id = rand(1,5);
                if (!$article->categories()->find($category_id))
                    $article->categories()->attach($category_id);
            }

            for ($i=1 ; $i<=rand(0,10) ; $i++){
                $article->comments()->save(factory(Comment::class)->make());
            }
        });
    }
}
