<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('ticket.table', 'tickets'), function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('subject');
            $table->enum('entity', config('ticket.entities'))->index();
            $table->integer('entity_id')->index();
            $table->unsignedInteger('assigned_user')->index()->nullable();
            $table->unsignedInteger('category_id')->index()->nullable();
            $table->unsignedInteger('internal_group_id')->index()->nullable();
            $table->enum('status', ['open', 're-open', 'closed', 'archived'])->default('open');
            $table->enum('waiting_response_from', ['user', 'entity']);
            $table->enum('priority', ['low', 'normal', 'high'])->index()->default('low');
            $table->enum('closed_by', ['user', 'entity'])->nullable();
            $table->timestamp(config('ticket.timestamps.created', 'created_at'))->useCurrent();
            $table->integer('created_by')->nullable()->comment('if ticket is created by user then its the user_id otherwise is null');
            $table->timestamp(config('ticket.timestamps.updated', 'updated_at'))->nullable()->useCurrentOnUpdate();
            $table->integer('modified_by')->nullable()->comment('if ticket is updated by user then its the user_id otherwise is null');
            $table->timestamp(config('ticket.timestamps.deleted', 'deleted_at'))->nullable()->useCurrentOnUpdate();
            $table->integer('deleted_by')->nullable()->comment('if ticket is deleted by user then its the user_id otherwise is null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('ticket.table', 'tickets'));
    }
}
