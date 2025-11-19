<?php

namespace App\Facades;

use App\Contracts\HtmlRendererInterface;
use Illuminate\Support\Facades\Facade;

class Html extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return HtmlRendererInterface::class;
    }
}
