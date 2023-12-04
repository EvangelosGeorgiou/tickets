<?php

namespace EvanGeo\Ticket\Repository;

use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TicketAttachmentRepository
{
    /**
     * @param  Collection<File>|File[]  $files
     */
    public function upload(array|Collection $files, string $path): self
    {
        $files = is_array($files) ? collect($files) : $files;
        $path = Str::endsWith('/', $path) ? $path : "$path/";

        $files->whereInstanceOf(File::class)
            ->each(fn (File $file) => Storage::disk(config('ticket.attachments.upload_disk'))
                ->put($path.$file->getFilename(), $file->getContent()));

        return $this;
    }
}
