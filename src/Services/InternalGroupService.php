<?php

namespace EvanGeo\Ticket\Services;

use EvanGeo\Ticket\Models\TicketInternalGroup;
use EvanGeo\Ticket\Repository\TicketInternalGroupRepository;
use Illuminate\Support\Collection;

class InternalGroupService
{
    public function create(array $data): TicketInternalGroupRepository
    {
        $category = TicketInternalGroup::query()->create($data);

        return new TicketInternalGroupRepository($category);
    }

    /**
     * @param  array<array>  $data
     */
    public function insert(array $data): self
    {
        TicketInternalGroup::query()->insert($data);

        return $this;
    }

    public function getById($id): TicketInternalGroupRepository
    {
        $category = TicketInternalGroup::query()->findOrFail($id);

        return new TicketInternalGroupRepository($category);
    }

    /**
     * @return Collection<TicketInternalGroup>
     */
    public function all(): Collection
    {
        $categories = TicketInternalGroup::all();

        return $categories->map(fn ($c) => new TicketInternalGroup((array) $c));
    }

    public function delete($id): self
    {
        $this->getById($id)->delete();

        return $this;
    }

    public function deleteMany(array $ids): static
    {
        TicketInternalGroup::query()->whereIn('id', $ids)->delete();

        return $this;
    }

    public function forceDelete(int $id): static
    {
        TicketInternalGroup::query()->where('id', $id)->forceDelete();

        return $this;
    }
}
