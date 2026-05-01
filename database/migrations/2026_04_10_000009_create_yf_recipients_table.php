<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yf_recipients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yf_user_id');
            $table->string('name', 150);
            $table->enum('payment_method', ['alipay', 'wechat']);
            $table->string('alipay_id', 100)->nullable();
            $table->string('wechat_id', 100)->nullable();
            $table->string('bank', 100)->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('last_used')->nullable();
            $table->timestamps();

            $table->foreign('yf_user_id')->references('id')->on('yf_users')->onDelete('cascade');
            $table->index('yf_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yf_recipients');
    }
};
