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
        Schema::create(config('ticket.tags', 'ticket_tags'), function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('entity', config('ticket.entities'));
            $table->boolean('enabled')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('ticket.tags', 'ticket_tags'));
    }
};
