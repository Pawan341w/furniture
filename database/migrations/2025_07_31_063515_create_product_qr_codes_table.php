<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('product_qr_codes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->string('code')->unique(); // unique QR identifier
        $table->string('coin_reward')->default(0);
        $table->boolean('is_used')->default(false); // true after scan
        $table->string('path');
        $table->timestamp('used_at')->nullable();
        $table->unsignedBigInteger('used_by')->nullable(); // user ID who scanned
        $table->timestamps();

        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('used_by')->references('id')->on('users')->nullOnDelete();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_qr_codes');
    }
};
