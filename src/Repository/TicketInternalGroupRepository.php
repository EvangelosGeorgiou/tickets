<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Models\TicketInternalGroup;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string entity
 * @property bool enabled
 */
class TicketInternalGroupRepository implements Arrayable
{
    private TicketInternalGroup|Model $group;

    public function __construct(TicketInternalGroup|Model $group)
    {
        $this->group = $group;
    }

    public function __get(string $name)
    {
        return $this->group->{$name};
    }

    public function update(array $data): TicketInternalGroupRepository
    {
        $this->group->update($data);

        $this->group->refresh();

        return $this;
    }

    public function toggleEnabled(): TicketInternalGroupRepository
    {
        $this->group->update(['enabled' => ! $this->group->enabled]);

        $this->group->refresh();

        return $this;
    }

    public function delete(): self
    {
        $this->group->delete();

        return $this;
    }

    public function toArray(): array
    {
        return $this->group->toArray();
    }
}
