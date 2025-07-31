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
Schema::create('products', function (Blueprint $table) {
        $table->id();

        // Foreign Key
        $table->unsignedBigInteger('category_id');

        // Product Info
        $table->string('name');
        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);

        $table->string('dimensions')->nullable();    // e.g. 6x3x2 feet
        $table->float('weight')->nullable();         // in KG
        $table->integer('stock_quantity')->default(0);
        $table->boolean('is_available')->default(true);

        $table->string('qr_code_path')->nullable();   // QR image storage path
        $table->string('image')->nullable();     // Main product image
        $table->string('gallery_image')->nullable();  // Gallery image (one only)

        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
