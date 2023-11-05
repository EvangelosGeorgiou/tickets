<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Database\Factories\TagsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string entity
 * @property bool enabled
 */
class Tags extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;

    protected static function newFactory(): TagsFactory
    {
        return TagsFactory::new();
    }

    public function getTable()
    {
        return config('ticket.tags', 'ticket_tags');
    }
}
