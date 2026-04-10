<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yf_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yf_user_id');
            $table->string('type', 50);
            $table->string('title');
            $table->text('message');
            $table->json('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('yf_user_id')->references('id')->on('yf_users')->onDelete('cascade');
            $table->index('yf_user_id');
            $table->index('read_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yf_notifications');
    }
};
