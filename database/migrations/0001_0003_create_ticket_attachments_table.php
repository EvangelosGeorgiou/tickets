<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('ticket.attachments.table', 'ticket_attachments'), function (Blueprint $table) {
            $table->id();
            //            $table->unsignedInteger('ticket_id')->index();
            $table->unsignedInteger('response_id')->index();
            $table->string('name');
            $table->string('mime');
            $table->timestamp(config('ticket.timestamps.created', 'created_at'))->useCurrent();
            $table->integer('created_by')->nullable()->comment('if ticket is created by user then its the user_id otherwise is null');
            $table->timestamp(config('ticket.timestamps.updated', 'updated_at'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable()->comment('if ticket is updated by user then its the user_id otherwise is null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('ticket.attachments.table', 'ticket_attachments'));
    }
}
