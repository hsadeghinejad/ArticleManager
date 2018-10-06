<?php
/**
 * AdminPanel
 * User: Hamed Sadeghinejad
 * Email: h.sadeghynejad@gmail.com
 * Date: 28/09/2018
 * Time: 12:54 PM
 */

namespace HamedSadeghi\ArticleManager\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = [
        'password',
        'rememberd_token'
    ];

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}