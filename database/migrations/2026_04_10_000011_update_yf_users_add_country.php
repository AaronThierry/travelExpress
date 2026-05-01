<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('yf_users', function (Blueprint $table) {
            $table->string('country', 5)->nullable()->after('date_of_birth');
            $table->string('avatar_url')->nullable()->after('country');
            $table->boolean('is_profile_complete')->default(false)->after('avatar_url');
        });
    }

    public function down(): void
    {
        Schema::table('yf_users', function (Blueprint $table) {
            $table->dropColumn(['country', 'avatar_url', 'is_profile_complete']);
        });
    }
};
