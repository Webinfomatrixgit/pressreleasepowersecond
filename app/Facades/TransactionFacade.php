<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TransactionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'transaction'; // Must match the service binding key
    }
}
