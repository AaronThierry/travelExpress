<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'employe', 'client'])->default('client')->after('password');
            $table->string('telephone', 20)->nullable()->after('role');
            $table->text('adresse')->nullable()->after('telephone');
            $table->string('photo_profil')->nullable()->after('adresse');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'telephone', 'adresse', 'photo_profil']);
        });
    }
};
