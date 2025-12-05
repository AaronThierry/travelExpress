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
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone'); // Pour WhatsApp
            $table->string('country')->nullable();
            $table->string('destination'); // china, spain, germany
            $table->string('project_type'); // etudes, travail, business
            $table->string('project_details')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'contacted', 'in_progress', 'completed', 'cancelled'])->default('new');
            $table->text('admin_notes')->nullable(); // Notes internes de l'admin
            $table->timestamp('contacted_at')->nullable(); // Date du premier contact
            $table->timestamp('last_contact_at')->nullable(); // Date du dernier contact
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete(); // Admin assigné
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};
