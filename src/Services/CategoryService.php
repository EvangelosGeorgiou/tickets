<?php

namespace EvanGeo\Ticket\Services;

use EvanGeo\Ticket\Models\Category;
use EvanGeo\Ticket\Repository\CategoryRepository;
use Illuminate\Support\Collection;

class CategoryService
{
    public function create(array $data): CategoryRepository
    {
        $category = Category::query()->create($data);

        return new CategoryRepository($category);
    }

    /**
     * @param  array<array>  $data
     */
    public function insert(array $data): self
    {
        Category::query()->insert($data);

        return $this;
    }

    public function getById($id): CategoryRepository
    {
        $category = Category::query()->findOrFail($id);

        return new CategoryRepository($category);
    }

    /**
     * @return Collection<Category>
     */
    public function getAll(): Collection
    {
        $categories = Category::all();

        return $categories->map(fn ($c) => new Category((array) $c));
    }

    public function delete($id): self
    {
        $this->getById($id)->delete();

        return $this;
    }

    public function bulkDelete(array $ids): static
    {
        Category::query()->whereIn('id', $ids)->delete();

        return $this;
    }
}
