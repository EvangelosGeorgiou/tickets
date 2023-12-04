<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Concerns\HasTimestamps;
use EvanGeo\Ticket\Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int id
 * @property string uuid
 * @property string subject
 * @property string entity
 * @property int entity_id
 * @property int assigned_user
 * @property string status
 * @property int category_id
 * @property int internal_group_id
 * @property string waiting_response_from
 * @property int priority
 * @property int closed_by
 * @property int created_by
 * @property int updated_by
 * @property Collection<TicketResponse> $responses
 * @property TicketCategory $category
 * @property TicketInternalGroup $internal_group
 */
class Ticket extends Model
{
    use HasFactory,
        HasTimestamps,
        SoftDeletes;

    protected $guarded = ['id'];

    protected static function newFactory(): TicketFactory
    {
        return TicketFactory::new();
    }

    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($ticket) {
            $ticket->uuid = $ticket->entity_id.'-'.Str::random(10);
        });
    }

    public function getDeletedAtColumn()
    {
        return config('ticket.timestamps.deleted', 'deleted_at');
    }

    public function getTable()
    {
        return config('ticket.table', 'tickets');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(TicketResponse::class, 'ticket_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tags::class,
            config('ticket.ticket_tags_pivot', 'ticket_tags_pivot'),
            'ticket_id',
            'tag_id');
    }

    public function category(): HasOne
    {
        return $this->hasOne(TicketCategory::class, 'id', 'category_id');
    }

    public function internal_group(): HasOne
    {
        return $this->hasOne(TicketInternalGroup::class, 'id', 'internal_group_id');
    }
}
