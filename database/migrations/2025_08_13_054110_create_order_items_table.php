<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('address_id')->constrained('addresses')->onDelete('cascade');
            $table->string('address');
            $table->string('txn_id');
            $table->string('order_number')->unique();
             $table->string('product_name'); 
            $table->decimal('product_amount', 10, 2); 
            $table->decimal('shipping_charge', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2);

            $table->enum('payment_method', ['cod', 'online', 'wallet'])->default('cod');
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');

            $table->enum('order_status', [
                'pending',
                'processing',
                'shipped',
                'delivered',
                'cancelled',
                'returned'
            ])->default('pending');

            $table->timestamp('ordered_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
