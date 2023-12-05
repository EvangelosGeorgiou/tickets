<?php

namespace EvanGeo\Ticket;

use EvanGeo\Ticket\Enums\WaitingResponseFrom;
use EvanGeo\Ticket\Models\Ticket;
use EvanGeo\Ticket\Repository\TicketRepository;
use EvanGeo\Ticket\Services\CategoryService;
use EvanGeo\Ticket\Services\InternalGroupService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Tickets
{
    public CategoryService $category;

    public InternalGroupService $internalGroup;

    public function __construct(CategoryService $category, InternalGroupService $internalGroup)
    {
        $this->category = $category;
        $this->internalGroup = $internalGroup;
    }

    public function createAsUser(Model|int $user, array $data): TicketRepository
    {
        $user = $user instanceof Model ? $user->getKey() : $user;

        $data = array_merge($data, [
            'waiting_response_from' => WaitingResponseFrom::ENTITY,
            'created_by' => $user,
        ]);

        $ticket = Ticket::query()->create($data);

        return new TicketRepository($ticket);
    }

    public function createAsEntity($entity, array $data): TicketRepository
    {
        $data = array_merge($data, [
            'waiting_response_from' => WaitingResponseFrom::USER,
            'entity' => $entity,
        ]);

        $ticket = Ticket::query()->create($data);

        return new TicketRepository($ticket);
    }

    public function getById(int $id): TicketRepository
    {
        /** @var Ticket $ticket */
        $ticket = Ticket::query()->findOrFail($id);

        return new TicketRepository($ticket);
    }

    public function getByEntity(string $entity): Collection
    {
        return Ticket::query()
            ->where('entity', $entity)
            ->get();
    }

    public function getByEntityId($entity, $id): Collection
    {
        return Ticket::query()
            ->where([
                'entity' => $entity,
                'entity_id' => $id,
            ])->get();
    }

    public function getAssignToUser(int $userId): Collection
    {
        return Ticket::query()
            ->where('assigned_user', $userId)
            ->get();
    }

    public function getCreatedByUser(): Collection
    {
        return Ticket::query()
            ->whereNotNull('created_by')
            ->get();
    }

    public function query(): Builder
    {
        return Ticket::query();
    }
}
