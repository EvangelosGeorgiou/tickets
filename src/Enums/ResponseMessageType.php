<?php

namespace EvanGeo\Ticket\Enums;

enum ResponseMessageType: string
{
    case EXTERNAL = 'external';
    case INTERNAL = 'internal';
}
