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
        Schema::table('student_applications', function (Blueprint $table) {
            $table->string('access_token', 64)->nullable()->unique()->after('unique_token');
            $table->timestamp('token_expires_at')->nullable()->after('access_token');
            $table->timestamp('student_submitted_at')->nullable()->after('token_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_applications', function (Blueprint $table) {
            $table->dropColumn([
                'access_token',
                'token_expires_at',
                'student_submitted_at',
            ]);
        });
    }
};
