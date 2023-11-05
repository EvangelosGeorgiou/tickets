<?php

namespace EvanGeo\Ticket\Enums;

enum Status: string
{
    case OPEN = 'open';
    case REOPEN = 're-open';
    case CLOSED = 'closed';
    case ARCHIVED = 'archived';

}
