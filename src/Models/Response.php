<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Concerns\HasTimestamps;
use EvanGeo\Ticket\Database\Factories\ResponseFactory;
use EvanGeo\Ticket\Enums\ResponseMessageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int id
 * @property string message
 * @property ResponseMessageType type
 */
class Response extends Model
{
    use HasFactory,
        HasTimestamps,
        SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => ResponseMessageType::class,
    ];

    protected static function newFactory(): ResponseFactory
    {
        return ResponseFactory::new();
    }

    public function getDeletedAtColumn()
    {
        return config('ticket.timestamps.deleted', 'deleted_at');
    }

    public function getTable()
    {
        return config('ticket.responses', 'ticket_responses');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'response_id', 'id');
    }
}
