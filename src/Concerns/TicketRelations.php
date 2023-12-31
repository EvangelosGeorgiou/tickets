<?php

namespace EvanGeo\Ticket\Concerns;

use EvanGeo\Ticket\Repository\TicketCategoryRepository;
use EvanGeo\Ticket\Repository\TicketInternalGroupRepository;
use EvanGeo\Ticket\Repository\TicketResponseRepository;
use Illuminate\Support\Collection;

trait TicketRelations
{
    public function getCategory(): ?TicketCategoryRepository
    {
        if (is_null($this->category_id)) {
            return null;
        }

        return new TicketCategoryRepository($this->category);
    }

    public function getResponses(): ?Collection
    {
        $responses = $this->responses;

        if ($responses->count() === 0) {
            return null;
        }

        return $responses->map(fn ($r) => new TicketResponseRepository($this->ticket, $r));
    }

    public function getInternalGroup(): ?TicketInternalGroupRepository
    {
        if (is_null($this->ticket->internal_group_id)) {
            return null;
        }

        return new TicketInternalGroupRepository($this->ticket->internal_group);
    }

    public function loadResponses(): self
    {
        $this->ticket->load('responses');

        return $this;
    }

    public function loadCategory(): self
    {
        $this->ticket->load('category');

        return $this;
    }

    public function loadInternalGroup(): self
    {
        $this->ticket->load('internal_group');

        return $this;
    }

    /**
     * Creates new tags for the ticket
     */
    public function attachTags(array $tagIds): self
    {
        $this->ticket->tags()->attach($tagIds);

        return $this;
    }

    /**
     * Remove tags from the ticket
     */
    public function detachTags(array $tagIds): self
    {
        $this->ticket->tags()->detach($tagIds);

        return $this;
    }

    /**
     * Remove all tags and creates new ones
     */
    public function syncTags(array $tagIds): self
    {
        $this->ticket->tags()->sync($tagIds);

        return $this;
    }
}
