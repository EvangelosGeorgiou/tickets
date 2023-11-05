<?php

namespace EvanGeo\Ticket\Models;

use EvanGeo\Ticket\Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string entity
 * @property bool enabled
 */
class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = ['id'];

    protected static function newFactory(): CategoryFactory
    {
        return CategoryFactory::new();
    }

    public function getTable()
    {
        return config('ticket.category', 'ticket_categories');
    }
}
