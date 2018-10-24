<?php
namespace HamedSadeghi\ArticleManager;

use HamedSadeghi\AdminPanel\AdminPanel;
use HamedSadeghi\ArticleManager\Models\Article;
use HamedSadeghi\ArticleManager\Models\Category;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\AliasLoader;
use View;
use Route;
use Illuminate\Support\ServiceProvider;
use Blade;

class ArticleManagerServiceProvider extends ServiceProvider
{
    public function register(){
        $this->app->bind('ArticleManager', function(){
            return new ArticleManager();
        });

        $this->app->register(\HamedSadeghi\AdminPanel\AdminPanelServiceProvider::class);
        AliasLoader::getInstance()->alias('AdminPanel', AdminPanel::class);
        AliasLoader::getInstance()->alias('ArticleManager', ArticleManagerFacade::class);

        $this->mergeConfigFrom(__DIR__ . '/config/app.php', 'articlemanager');

        $this->registerEloquentFactoryLoader(__DIR__ . '/database/factories/');
    }

    public function boot(){
        require(__DIR__ . '/routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'articlemanager');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'articlemanager');

        Route::bind('article_id', function($article_id){
            return Article::find($article_id);
        });

        \Menu::make('sidebar', function($menu){
            $menu->add('مدیریت مقالات', '#')
                    ->attr('icon', 'newspaper')
                    ->nickname('articles');
            $menu->articles->add('افزودن مقاله', ['route' => 'admin.article.form']);
            $menu->articles->add('لیست مقالات', ['route' => 'admin.articles']);
        });

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('articlemanager')
        ], 'ArticleManager-assets');

        Blade::directive('article_date', function($time){
            return "<?php echo Verta::instance($time); ?>";
        });

        Blade::directive('article_date_ago', function($time){
            return "<?php echo (new Verta($time))->formatDifference(verta()) ?>";
        });

//        View::composer('layouts.blocks.links', function($view){
//           $categories = Category::all();
//
//           $view->with('categories', $categories);
//        });

        View::composer('articlemanager::categories', function($view){
            $categories = Category::all();

            $view->with('categories', $categories);
        });

        View::composer('articlemanager::blog', function(\Illuminate\View\View $view){
            if (!array_key_exists('articles', $view->getData())) {
                $articles = Article::latest()->paginate(config('articlemanager.paginate_rows', 10));
                $view->with('articles', $articles);
            }
        });
    }

    public function registerEloquentFactoryLoader($path){
        $this->app->make(Factory::class)->load($path);
    }
}