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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('priority')->default('normal'); // low, normal, high, urgent
            $table->string('type')->default('general'); // general, maintenance, feature, important
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by'); // admin who created it
            $table->timestamp('expires_at')->nullable(); // optional expiry date
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
