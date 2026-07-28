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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->string('product_name');
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->text('description');
            $table->decimal('purchase_price',10,2);
            $table->decimal('selling_price',10,2);
            $table->integer('stock_quantity')->default(0);
            $table->integer('minimum_stock')->default(0);
            $table->string('unit');
            $table->string('product_image')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
