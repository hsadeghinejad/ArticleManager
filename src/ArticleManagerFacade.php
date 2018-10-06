<?php
namespace HamedSadeghi\ArticleManager;

use Illuminate\Support\Facades\Facade;

class ArticleManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ArticleManager';
    }
}