<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ArticleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'articles'; // Must match the service binding key
    }
}