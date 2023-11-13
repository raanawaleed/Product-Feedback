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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The user to whom the notification is related
            $table->unsignedBigInteger('feedback_id')->nullable(); // The feedback item related to the notification (nullable if not related)
            $table->text('message'); // The notification message
            $table->boolean('read')->default(false); // Indicates whether the notification has been read
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('feedback_id')->references('id')->on('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
