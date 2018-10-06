<?php
/**
 * AdminPanel
 * User: Hamed Sadeghinejad
 * Email: h.sadeghynejad@gmail.com
 * Date: 28/09/2018
 * Time: 01:13 PM
 */

namespace HamedSadeghi\ArticleManager\Http\Controllers;

use HamedSadeghi\ArticleManager\Models\Category;

class CategoryController
{
    public function view(Category $category)
    {
        $articles = $category->articles()->paginate(config('articlemanager.paginate_rows', 10));

        return view('articlemanager::blog', compact('articles'));
    }
}