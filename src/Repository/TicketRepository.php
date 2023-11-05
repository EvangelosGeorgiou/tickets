<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Concerns\HasResponses;
use EvanGeo\Ticket\Concerns\InteractWithTicket;
use EvanGeo\Ticket\Concerns\TicketRelations;
use EvanGeo\Ticket\Models\Category;
use EvanGeo\Ticket\Models\Response;
use EvanGeo\Ticket\Models\Ticket;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string uuid
 * @property string subject
 * @property string entity
 * @property int entity_id
 * @property int assigned_user
 * @property string status
 * @property string waiting_response_from
 * @property int category_id
 * @property int internal_group_id
 * @property int priority
 * @property int closed_by
 * @property int created_by
 * @property int updated_by
 * @property Collection<Response> responses
 * @property Category category
 */
class TicketRepository implements Arrayable
{
    use HasResponses,
        InteractWithTicket,
        TicketRelations;

    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function __get($name)
    {
        return $this->ticket->{$name};
    }

    public function toArray(): array
    {
        return $this->ticket->toArray();
    }
}
