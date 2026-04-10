<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('yf_user_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('chinese_name', 100)->nullable();
            $table->string('phone', 20);
            $table->string('country_code', 5)->default('+86');
            $table->string('bank_name', 100);
            $table->string('bank_account_number', 50);
            $table->string('bank_code', 20)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('relationship', 50)->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            $table->foreign('yf_user_id')->references('id')->on('yf_users')->onDelete('cascade');
            $table->index('yf_user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
