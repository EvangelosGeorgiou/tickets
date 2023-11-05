<?php

namespace EvanGeo\Ticket\Concerns;

trait HasTimestamps
{
    public function getCreatedAtColumn(): ?string
    {
        return config('ticket.timestamps.created', self::CREATED_AT);
    }

    public function getUpdatedAtColumn(): ?string
    {
        return config('ticket.timestamps.updated', self::UPDATED_AT);
    }
}
