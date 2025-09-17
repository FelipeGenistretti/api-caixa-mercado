<?php

namespace App\Factories;

use App\Services\RemoveItemCartService;

class MakeRemoveItemCartService
{
    public static function make(): RemoveItemCartService
    {
        return new RemoveItemCartService();
    }
}
