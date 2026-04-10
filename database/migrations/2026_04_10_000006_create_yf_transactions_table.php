<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yf_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_ref', 50)->unique();
            $table->unsignedBigInteger('yf_user_id');
            $table->unsignedBigInteger('beneficiary_id');

            // Montants
            $table->decimal('send_amount', 15, 2);
            $table->string('send_currency', 3)->default('XOF');
            $table->decimal('receive_amount', 15, 2);
            $table->string('receive_currency', 3)->default('CNY');
            $table->decimal('exchange_rate', 10, 6);

            // Frais
            $table->decimal('transfer_fee', 10, 2)->default(0.00);
            $table->decimal('total_amount', 15, 2);

            // Statut
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'cancelled', 'refunded'])->default('pending');

            // Paiement
            $table->string('payment_method', 50);
            $table->string('payment_reference', 100)->nullable();
            $table->timestamp('payment_completed_at')->nullable();

            // Réception
            $table->string('payout_method', 50)->default('bank_transfer');
            $table->string('payout_reference', 100)->nullable();
            $table->timestamp('payout_completed_at')->nullable();

            // Métadonnées
            $table->string('reason')->nullable();
            $table->text('notes')->nullable();
            $table->text('failed_reason')->nullable();

            $table->timestamps();

            $table->foreign('yf_user_id')->references('id')->on('yf_users')->onDelete('cascade');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries')->onDelete('restrict');

            $table->index('yf_user_id');
            $table->index('beneficiary_id');
            $table->index('transaction_ref');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yf_transactions');
    }
};
