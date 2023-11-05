<?php

namespace EvanGeo\Ticket\Enums;

use Illuminate\Support\Collection;

enum Priority: string
{
    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';

    public static function collect(): Collection
    {
        return collect([self::LOW, self::NORMAL, self::HIGH]);
    }

    public static function getValues(): Collection
    {
        return self::collect()->pluck('value');
    }
}
