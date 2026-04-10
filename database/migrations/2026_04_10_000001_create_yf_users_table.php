<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yf_users', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 20)->unique();
            $table->string('country_code', 5)->default('+226');
            $table->string('email')->unique()->nullable();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('date_of_birth')->nullable();

            // KYC
            $table->enum('kyc_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('kyc_document_type', 50)->nullable();
            $table->string('kyc_document_number', 100)->nullable();
            $table->string('kyc_document_front')->nullable();
            $table->string('kyc_document_back')->nullable();

            // Sécurité
            $table->string('pin_hash');
            $table->boolean('biometric_enabled')->default(false);
            $table->enum('status', ['active', 'suspended', 'blocked'])->default('active');

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamps();

            $table->index('phone');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yf_users');
    }
};
