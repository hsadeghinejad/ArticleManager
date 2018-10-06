<?php
/**
 * ArticleManger
 * User: Hamed Sadeghinejad
 * Email: h.sadeghynejad@gmail.com
 * Date: 28/09/2018
 * Time: 12:48 PM
 */

namespace HamedSadeghi\ArticleManager\Http\Controllers;


use App\Http\Controllers\Controller;
use HamedSadeghi\ArticleManager\Models\Article;
use HamedSadeghi\ArticleManager\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Article $article){
        $this->validate(request(), [
            'body' => 'required|min:5'
        ]);

        $user = Auth::user();
        Comment::create([
            'article_id' => $article->id,
            'user_id' => $user->id,
            'body' => request('body')
        ]);

        return back();
    }
}