<?php

namespace EvanGeo\Ticket\Concerns;

use EvanGeo\Ticket\Enums\Priority;
use EvanGeo\Ticket\Enums\Status;
use EvanGeo\Ticket\Enums\WaitingResponseFrom;
use EvanGeo\Ticket\Repository\TicketRepository;

trait InteractWithTicket
{
    public function open(int $userId = null): self
    {
        return $this->updateStatus(Status::OPEN, $userId);
    }

    public function reOpen(int $userId = null): self
    {
        return $this->updateStatus(Status::REOPEN, $userId);

    }

    public function closed(int $userId = null): self
    {
        return $this->updateStatus(Status::CLOSED, $userId);

    }

    public function archived(int $userId = null): self
    {
        return $this->updateStatus(Status::ARCHIVED, $userId);
    }

    public function priorityLow(int $userId = null): self
    {
        return $this->updatePriority(Priority::LOW, $userId);
    }

    public function priorityNormal(int $userId = null): self
    {
        return $this->updatePriority(Priority::NORMAL, $userId);
    }

    public function priorityHigh(int $userId = null): self
    {
        return $this->updatePriority(Priority::HIGH, $userId);
    }

    public function waitingFromEntity(int $userId = null): self
    {
        return $this->updateWaitingFrom(WaitingResponseFrom::ENTITY, $userId);
    }

    public function waitingFromUser(): self
    {
        return $this->updateWaitingFrom(WaitingResponseFrom::USER);
    }

    public function setCategory(int $categoryId = null): self
    {
        $this->ticket->update(['category_id' => $categoryId]);

        $this->ticket->refresh();

        return $this;
    }

    public function removeCategory(): TicketRepository
    {
        return $this->setCategory();
    }

    public function setInternalGroup(int $groupId = null): self
    {
        $this->ticket->update(['internal_group_id' => $groupId]);

        $this->ticket->refresh();

        return $this;
    }

    public function removeInternalGroup(): TicketRepository
    {
        return $this->setInternalGroup();
    }

    public function assignToUser($userId): self
    {
        $this->ticket->update(['assigned_user' => $userId]);

        $this->ticket->refresh();

        return $this;
    }

    private function updateWaitingFrom(WaitingResponseFrom $responseFrom, int $userId = null): self
    {
        $this->ticket->update([
            'waiting_from' => $responseFrom->value,
            'modified_by' => $userId,
        ]);

        $this->ticket->refresh();

        return $this;
    }

    private function updateStatus(Status $status, int $userId = null): self
    {
        $this->ticket->update([
            'status' => $status->value,
            'modified_by' => $userId,
        ]);

        $this->ticket->refresh();

        return $this;
    }

    private function updatePriority(Priority $priority, int $userId = null): self
    {
        $this->ticket->update([
            'priority' => $priority->value,
            'modified_by' => $userId,
        ]);

        $this->ticket->refresh();

        return $this;
    }
}
