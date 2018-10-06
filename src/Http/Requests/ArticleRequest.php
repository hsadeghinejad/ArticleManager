<?php
namespace HamedSadeghi\ArticleManager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required|min:10'
        ];
    }
}