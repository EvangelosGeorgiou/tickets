<?php

namespace EvanGeo\Ticket\Repository;

use EvanGeo\Ticket\Concerns\HasAttachments;
use EvanGeo\Ticket\Enums\ResponseMessageType;
use EvanGeo\Ticket\Models\Response;
use EvanGeo\Ticket\Models\Ticket;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @property int id
 * @property string message
 * @property ResponseMessageType type
 */
class ResponseRepository extends Repository implements Arrayable
{
    use HasAttachments;

    protected Response $response;

    public function __construct(Ticket $ticket, Response $response)
    {
        parent::__construct($ticket);
        $this->response = $response;
    }

    public function __get(string $name)
    {
        return $this->response->{$name};
    }

    public function markAsExternalMessage(): self
    {
        return $this->updateMessageType(ResponseMessageType::EXTERNAL);
    }

    public function markAsInternalMessage(): self
    {
        return $this->updateMessageType(ResponseMessageType::INTERNAL);
    }

    private function updateMessageType(ResponseMessageType $type): self
    {
        $this->response->update(['type' => $type]);

        $this->response->refresh();

        return $this;
    }

    public function toArray(): array
    {
        return $this->response->toArray();
    }
}
