<?php
namespace HamedSadeghi\ArticleManager\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function articles(){
        return $this->belongsToMany(Article::class);
    }
}