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
        Schema::create('wallet_transactions', function (Blueprint $table) {
             $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->enum('type', ['credit', 'debit']);
    $table->decimal('amount', 12, 2);
    $table->string('message')->nullable();
    $table->string('utr')->nullable();
    $table->string('transaction_id')->unique(); // Unique transaction ID
    $table->decimal('balance_before', 12, 2);
    $table->json('bank_details')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
