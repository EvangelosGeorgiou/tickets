<?php

namespace EvanGeo\Ticket\Enums;

enum WaitingResponseFrom: string
{
    case USER = 'user';
    case ENTITY = 'entity';
}
