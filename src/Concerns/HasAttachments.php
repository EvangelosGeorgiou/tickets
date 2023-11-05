<?php

namespace EvanGeo\Ticket\Concerns;

use Closure;
use EvanGeo\Ticket\Repository\AttachmentRepository;

trait HasAttachments
{
    /**
     * @param  array<array>  $documents
     */
    public function attachDocuments(array $documents, Closure $callback = null): self
    {
        $this->response->attachments()->createMany($documents);

        if (is_callable($callback)) {
            $callback(new AttachmentRepository());
        }

        return $this;
    }
}
