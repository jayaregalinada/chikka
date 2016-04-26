<?php

namespace Jag\Chikka;

use Illuminate\Support\Facades\Facade;

class ChikkaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'chikka';
    }
}
