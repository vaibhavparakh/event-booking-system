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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('from_date_time');
            $table->timestamp('to_date_time');
            $table->string('venue');
            $table->string('location_url');
            $table->string('organised_by');
            $table->decimal('duration_in_hrs', 5, 2);
            $table->string('cover_image_url');
            $table->decimal('entry_fee', 8, 2);
            $table->integer('capacity');
            $table->enum('type', ['free', 'paid']);
            $table->enum('status', ['draft', 'published']);
            $table->enum('category', ['conference', 'workshop', 'webinar', 'concert']);
            $table->enum('mode', ['online', 'offline']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
