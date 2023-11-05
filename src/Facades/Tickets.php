<?php

namespace EvanGeo\Ticket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EPLS/Ticket\Tickets\Tickets
 */
class Tickets extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EvanGeo\Ticket\Tickets::class;
    }
}
