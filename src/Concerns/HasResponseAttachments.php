<?php

namespace EvanGeo\Ticket\Concerns;

use Closure;
use EvanGeo\Ticket\Repository\TicketAttachmentRepository;

trait HasResponseAttachments
{
    /**
     * @param  array<array>  $documents
     */
    public function attachDocuments(array $documents, Closure $callback = null): self
    {
        $documents = collect($documents)->map(function ($document) {
            $document['ticket_id'] = $this->getTicket()->id;

            return $document;
        })->toArray();

        $this->response->attachments()->createMany($documents);

        if (is_callable($callback)) {
            $callback(new TicketAttachmentRepository());
        }

        return $this;
    }
}
