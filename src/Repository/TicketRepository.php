<?php

namespace EvanGeo\Ticket\Repository;

use Closure;
use EvanGeo\Ticket\Concerns\HasResponses;
use EvanGeo\Ticket\Concerns\InteractWithTicket;
use EvanGeo\Ticket\Concerns\TicketRelations;
use EvanGeo\Ticket\Models\Ticket;
use EvanGeo\Ticket\Models\TicketAttachment;
use EvanGeo\Ticket\Models\TicketCategory;
use EvanGeo\Ticket\Models\TicketInternalGroup;
use EvanGeo\Ticket\Models\TicketResponse;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int id
 * @property string uuid
 * @property string title
 * @property string description
 * @property string entity
 * @property int entity_id
 * @property int assigned_user
 * @property string status
 * @property int category_id
 * @property int internal_group_id
 * @property string waiting_response_from
 * @property int priority
 * @property int closed_by
 * @property int created_by
 * @property int updated_by
 * @property Collection<TicketResponse> $responses
 * @property TicketCategory $category
 * @property TicketInternalGroup $internal_group
 * @property Collection<TicketAttachment> $attachments
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

    public function attachDocuments(array $documents, Closure $callback = null): self
    {
        $this->ticket->attachments()->createMany($documents);

        if (is_callable($callback)) {
            $callback(new TicketAttachmentRepository());
        }

        return $this;
    }

    public function query(): Builder
    {
        return $this->ticket->query();
    }
}
