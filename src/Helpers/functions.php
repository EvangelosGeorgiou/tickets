<?php

use EvanGeo\Ticket\Services\CategoryService;
use EvanGeo\Ticket\Services\InternalGroupService;
use EvanGeo\Ticket\Tickets;
use Illuminate\Contracts\Container\BindingResolutionException;

if (! function_exists('ticket')) {
    /**
     * @throws BindingResolutionException
     */
    function ticket(): Tickets
    {
        return app()->make(Tickets::class);
    }
}

if (! function_exists('ticketCategory')) {
    /**
     * @throws BindingResolutionException
     */
    function ticketCategory(): CategoryService
    {
        return app()->make(CategoryService::class);
    }
}

if (! function_exists('ticketGroup')) {
    /**
     * @throws BindingResolutionException
     */
    function ticketGroup(): InternalGroupService
    {
        return app()->make(InternalGroupService::class);
    }
}
