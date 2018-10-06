<?php
namespace HamedSadeghi\ArticleManager\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'viewCount',
        'commentCount'
    ];

//    public function sluggable(){
//        return [
//            'slug' => [
//                'source' => 'slug'
//            ]
//        ];
//    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}