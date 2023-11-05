<?php

namespace EvanGeo\Ticket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int ticket_id
 * @property int tag_id
 * @property bool enabled
 */
class TicketTags extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function getTable()
    {
        return config('ticket.ticket_tags_pivot', 'ticket_tags_pivot');
    }
}
