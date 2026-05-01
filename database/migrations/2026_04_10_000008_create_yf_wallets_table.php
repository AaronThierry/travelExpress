<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yf_wallets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yf_user_id')->unique();
            $table->decimal('balance_xof', 15, 2)->default(0.00);
            $table->decimal('balance_cny', 15, 6)->default(0.000000);
            $table->timestamps();

            $table->foreign('yf_user_id')->references('id')->on('yf_users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yf_wallets');
    }
};
