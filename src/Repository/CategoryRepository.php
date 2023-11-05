<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Models\Category;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property bool enabled
 */
class CategoryRepository implements Arrayable
{
    private Category|Model $category;

    public function __construct(Category|Model $category)
    {
        $this->category = $category;
    }

    public function __get(string $name)
    {
        return $this->category->{$name};
    }

    public function update(array $data): CategoryRepository
    {
        $this->category->update($data);

        $this->category->refresh();

        return $this;
    }

    public function toggleEnabled(): CategoryRepository
    {
        $this->category->update(['enabled' => ! $this->category->enabled]);

        $this->category->refresh();

        return $this;
    }

    public function delete(): self
    {
        $this->category->delete();

        return $this;
    }

    public function toArray(): array
    {
        return $this->category->toArray();
    }
}
