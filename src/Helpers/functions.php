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

if (! function_exists('ticket_category')) {
    /**
     * @throws BindingResolutionException
     */
    function ticket_category(): CategoryService
    {
        return app()->make(CategoryService::class);
    }
}

if (! function_exists('ticket_group')) {
    /**
     * @throws BindingResolutionException
     */
    function ticket_group(): InternalGroupService
    {
        return app()->make(InternalGroupService::class);
    }
}
