<?php

return [

    /**
     * Ticket table name
     */
    'table' => 'tickets',

    /**
     * Ticket responses table name
     */
    'responses' => 'ticket_responses',

    /**
     * ticket attachments table
     */
    'attachments' => [
        'table' => 'ticket_attachments',
        'upload_disk' => 'local',
    ],

    /**
     * ticket category table
     */
    'category' => 'ticket_categories',

    /**
     * ticket internal group table
     */
    'internal_group' => 'ticket_internal_groups',

    /**
     * ticket tags table
     */
    'tags' => 'ticket_tags',

    /**
     * ticket tags pivot table
     */
    'ticket_tags_pivot' => 'ticket_tags_pivot',

    /**
     * system entities
     * add other entities except the `user`
     */
    'entities' => [
        'client',
    ],

    /**
     * name of the timestamps columns for the tables
     */
    'timestamps' => [
        'created' => 'created_at',
        'updated' => 'updated_at',
        'deleted' => 'deleted_at',
    ],
];
