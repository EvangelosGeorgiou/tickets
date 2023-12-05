<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Models\TicketCategory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property bool enabled
 */
class TicketCategoryRepository implements Arrayable
{
    private TicketCategory|Model $category;

    public function __construct(TicketCategory|Model $category)
    {
        $this->category = $category;
    }

    public function __get(string $name)
    {
        return $this->category->{$name};
    }

    public function update(array $data): TicketCategoryRepository
    {
        $this->category->update($data);

        $this->category->refresh();

        return $this;
    }

    public function toggleEnabled(): TicketCategoryRepository
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

    public function query(): Builder
    {
        return $this->category->query();
    }
}
