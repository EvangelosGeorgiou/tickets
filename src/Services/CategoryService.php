<?php

namespace EvanGeo\Ticket\Services;

use EvanGeo\Ticket\Models\TicketCategory;
use EvanGeo\Ticket\Repository\TicketCategoryRepository;
use Illuminate\Support\Collection;

class CategoryService
{
    public function create(array $data): TicketCategoryRepository
    {
        $category = TicketCategory::query()->create($data);

        return new TicketCategoryRepository($category);
    }

    /**
     * @param  array<array>  $data
     */
    public function insert(array $data): self
    {
        TicketCategory::query()->insert($data);

        return $this;
    }

    public function getById($id): TicketCategoryRepository
    {
        $category = TicketCategory::query()->findOrFail($id);

        return new TicketCategoryRepository($category);
    }

    /**
     * @return Collection<TicketCategory>
     */
    public function getAll(): Collection
    {
        $categories = TicketCategory::all();

        return $categories->map(fn ($c) => new TicketCategory((array) $c));
    }

    public function delete($id): self
    {
        $this->getById($id)->delete();

        return $this;
    }

    public function bulkDelete(array $ids): static
    {
        TicketCategory::query()->whereIn('id', $ids)->delete();

        return $this;
    }
}
