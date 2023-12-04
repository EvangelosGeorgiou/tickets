<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Database\Factories\InternalGroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string entity
 * @property bool enabled
 */
class TicketInternalGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    protected static function newFactory(): InternalGroupFactory
    {
        return InternalGroupFactory::new();
    }

    public function getTable()
    {
        return config('ticket.internal_group', 'ticket_internal_groups');
    }
}
