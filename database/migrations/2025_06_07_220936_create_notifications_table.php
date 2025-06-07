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
            $table->unsignedBigInteger('user_id'); // User who receives the notification
            $table->string('type'); // Type of notification (post_approved, new_comment)
            $table->string('title'); // Notification title
            $table->text('message'); // Notification message
            $table->unsignedBigInteger('post_id')->nullable(); // Related post ID
            $table->unsignedBigInteger('comment_id')->nullable(); // Related comment ID (if applicable)
            $table->boolean('is_read')->default(false); // Read status
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
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
