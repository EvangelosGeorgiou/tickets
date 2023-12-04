<?php

namespace EvanGeo\Ticket\Concerns;

use EvanGeo\Ticket\Enums\WaitingResponseFrom;
use EvanGeo\Ticket\Repository\TicketResponseRepository;
use Illuminate\Database\Eloquent\Model;

trait HasResponses
{
    public function replyAsUser(Model|int $user, array $data): TicketResponseRepository
    {
        $user = $user instanceof Model ? $user->getKey() : $user;
        $data['created_by'] = $user;
        $data['waiting_response_from'] = WaitingResponseFrom::ENTITY;

        return new TicketResponseRepository($this->ticket, $this->ticket->responses()->create($data));
    }

    public function replyAsEntity(array $data): TicketResponseRepository
    {
        $data['waiting_response_from'] = WaitingResponseFrom::USER;

        return new TicketResponseRepository($this->ticket, $this->ticket->responses()->create($data));
    }
}
