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
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable()->after('location');
            $table->string('whatsapp')->nullable()->after('country');
            $table->date('date_of_birth')->nullable()->after('whatsapp');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('nationality')->nullable()->after('gender');
            $table->string('language')->default('fr')->after('nationality');
            $table->text('interests')->nullable()->after('language');
            $table->string('linkedin')->nullable()->after('interests');
            $table->string('twitter')->nullable()->after('linkedin');
            $table->string('instagram')->nullable()->after('twitter');
            $table->boolean('profile_completed')->default(false)->after('instagram');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'country', 'whatsapp', 'date_of_birth', 'gender',
                'nationality', 'language', 'interests', 'linkedin',
                'twitter', 'instagram', 'profile_completed'
            ]);
        });
    }
};
