<?php

namespace EvanGeo\Ticket\Repository\Contracts;

use EvanGeo\Ticket\Repository\TicketRepository;

interface Repository
{
    public function getTicket(): TicketRepository;
}
