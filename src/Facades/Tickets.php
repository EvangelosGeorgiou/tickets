<?php

namespace EvanGeo\Ticket\Facades;

use EvanGeo\Ticket\Repository\TicketRepository;
use EvanGeo\Ticket\Services\CategoryService;
use EvanGeo\Ticket\Services\InternalGroupService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static TicketRepository createAsUser(Model|int $user, array $data)
 * @method static TicketRepository createAsEntity($entity, array $data)
 * @method static TicketRepository getById(int $id)
 * @method static Collection getByEntity(string $entity)
 * @method static CategoryService category()
 * @method static InternalGroupService internalGroup()
 *
 * @see \EvanGeo\Ticket\Tickets
 */
class Tickets extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EvanGeo\Ticket\Tickets::class;
    }
}
