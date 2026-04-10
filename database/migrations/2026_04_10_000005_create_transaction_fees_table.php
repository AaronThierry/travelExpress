<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_fees', function (Blueprint $table) {
            $table->id();
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->enum('fee_type', ['fixed', 'percentage', 'mixed']);
            $table->decimal('fixed_fee', 10, 2)->default(0.00);
            $table->decimal('percentage_fee', 5, 2)->default(0.00);
            $table->string('currency', 3)->default('XOF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_fees');
    }
};
