<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Models\InternalGroup;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string entity
 * @property bool enabled
 */
class InternalGroupRepository implements Arrayable
{
    private InternalGroup|Model $group;

    public function __construct(InternalGroup|Model $group)
    {
        $this->group = $group;
    }

    public function __get(string $name)
    {
        return $this->group->{$name};
    }

    public function update(array $data): InternalGroupRepository
    {
        $this->group->update($data);

        $this->group->refresh();

        return $this;
    }

    public function toggleEnabled(): InternalGroupRepository
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
