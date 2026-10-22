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
        Schema::create('sales_product_list_master', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')
            ->constrained('sales_master')
            ->cascadeOnDelete();

      $table->foreignId('product_id')
            ->constrained('product')
            ->restrictOnDelete();

      $table->decimal('quantity', 12, 2);
      $table->decimal('cost', 12, 2);
      $table->decimal('tax', 12, 2)->default(0);
      $table->decimal('total', 12, 2);

      $table->tinyInteger('status')->default(1);
      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_product_list_master');
    }
};
