<?php

namespace EvanGeo\Ticket\Services;

use EvanGeo\Ticket\Models\InternalGroup;
use EvanGeo\Ticket\Repository\InternalGroupRepository;
use Illuminate\Support\Collection;

class InternalGroupService
{
    public function create(array $data): InternalGroupRepository
    {
        $category = InternalGroup::query()->create($data);

        return new InternalGroupRepository($category);
    }

    /**
     * @param  array<array>  $data
     */
    public function insert(array $data): self
    {
        InternalGroup::query()->insert($data);

        return $this;
    }

    public function getById($id): InternalGroupRepository
    {
        $category = InternalGroup::query()->findOrFail($id);

        return new InternalGroupRepository($category);
    }

    /**
     * @return Collection<InternalGroup>
     */
    public function all(): Collection
    {
        $categories = InternalGroup::all();

        return $categories->map(fn ($c) => new InternalGroup((array) $c));
    }

    public function delete($id): self
    {
        $this->getById($id)->delete();

        return $this;
    }

    public function bulkDelete(array $ids): static
    {
        InternalGroup::query()->whereIn('id', $ids)->delete();

        return $this;
    }
}
