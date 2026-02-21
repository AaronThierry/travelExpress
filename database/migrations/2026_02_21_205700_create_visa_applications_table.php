<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('unique_token', 32)->unique();
            $table->string('access_token', 64)->nullable()->unique();
            $table->timestamp('token_expires_at')->nullable();

            $table->string('student_name')->nullable();
            $table->string('student_email')->nullable();
            $table->string('student_phone', 30)->nullable();
            $table->string('passport_number', 50)->nullable();

            $table->enum('status', ['pending', 'in_progress', 'complete', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('student_submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visa_applications');
    }
};
