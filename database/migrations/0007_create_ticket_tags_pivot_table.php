<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('ticket.ticket_tags_pivot', 'ticket_tags_pivot'), function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('ticket_id')->references('id')->on(config('ticket.tickets', 'tickets'))->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('tag_id')->references('id')->on(config('ticket.tags', 'ticket_tags'))->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('ticket.ticket_tags_pivot', 'ticket_tags_pivot'));
    }
};
