<?php
namespace HamedSadeghi\ArticleManager\Http\Controllers;

use App\Http\Controllers\Controller;
use HamedSadeghi\ArticleManager\Http\Requests\ArticleRequest;
use HamedSadeghi\ArticleManager\Models\Article;
use HamedSadeghi\ArticleManager\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    const ARTICLE_IMAGES_PATH = 'articles';

    public function blog(){
        return view('articlemanager::blog');
    }

    public function view(Article $article){
        return view('articlemanager::view', compact('article'));
    }

    public function index(){
        $articles = Article::latest()->paginate(config('articlemanager::paginate_rows'));

        return view('articlemanager::index', compact('articles'));
    }

    public function form(Article $article){
        $categories = Category::pluck('title', 'id');

        return view('articlemanager::form', compact('categories', 'article'));
    }

    public function store(ArticleRequest $request, Article $article){
//        $this->validate(request(), [
//            'title' => 'required',
//            'body' => 'required|min:5'
//        ]);

//        $validator = Validator::make(\request()->all(), [
//            'title' => 'required',
//            'body' => 'required|min:5'
//        ]);
//
//        if ($validator->fails()){
//            return redirect()
//                        ->back()
//                        ->withErrors($validator)
//                        ->withInput();
//        }

        if ($article->id){
            if ($request->hasFile('image')){
                if (!is_null($article->image))
                    Storage::delete($article->image);

                $image = $request->file('image')->store(ArticleController::ARTICLE_IMAGES_PATH);
                $article->image = $image;
                $article->save();
            }

            $article->update(\request(['title', 'body']));
            $article->categories()->sync(\request('categories'));
        }else{
            $article = Article::create([
                'user_id' => Auth::user()->id,
                'title' => \request('title'),
                'body' => \request('body'),
            ]);

            if ($request->hasFile('image')){
                $image = request()->file('image')->store(ArticleController::ARTICLE_IMAGES_PATH);
                $article->image = $image;
                $article->save();
            }

            $article->categories()->attach(\request('categories'));
        }

//        Article::create([
//            'user_id' => 1,
//            'title' => \request('title'),
//            'slug' => \request('title'),
//            'body' => \request('body')
//        ]);

        session()->flash('message', 'مقاله شما با موفقیت ثبت شد');

        return redirect()->route('admin.articles');
    }

    public function image(Article $article){
        header('Content-type: image/jpeg');
        header('Content-length', Storage::size($article->image));
        return readfile(storage_path('app/' . $article->image));
    }

    public function delete(Article $article){
        $article->delete();
        session()->flash('message', 'رکورد مورد نظر شما حذف شد');
        return redirect()->route('admin.articles');
    }
}