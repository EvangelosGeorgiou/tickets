<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Concerns\HasTimestamps;
use EvanGeo\Ticket\Database\Factories\AttachmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attachment extends Model
{
    use HasFactory,
        HasTimestamps,
        SoftDeletes;

    protected $guarded = ['id'];

    protected static function newFactory(): AttachmentFactory
    {
        return AttachmentFactory::new();
    }

    public function getDeletedAtColumn()
    {
        return config('ticket.timestamps.deleted', 'deleted_at');
    }

    public function getTable()
    {
        return config('ticket.attachments.table', 'ticket_attachments');
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class, 'id', 'response_id');
    }
}
