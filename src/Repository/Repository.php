<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Models\Ticket;

abstract class Repository implements Contracts\Repository
{
    protected Ticket $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function getTicket(): TicketRepository
    {
        return new TicketRepository($this->ticket);
    }
}
