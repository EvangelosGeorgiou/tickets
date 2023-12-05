<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Concerns\HasTimestamps;
use EvanGeo\Ticket\Database\Factories\ResponseFactory;
use EvanGeo\Ticket\Enums\ResponseMessageType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string message
 * @property ResponseMessageType type
 */
class TicketResponse extends Model
{
    use HasFactory,
        HasTimestamps;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => ResponseMessageType::class,
    ];

    protected static function newFactory(): ResponseFactory
    {
        return ResponseFactory::new();
    }

    public function getTable()
    {
        return config('ticket.responses', 'ticket_responses');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class, 'response_id', 'id');
    }
}
