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
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');

            $table->foreign('supplier_id')
                  ->references('id')
                  ->on('suppliers')
                  ->onDelete('cascade');
                  
            $table->string('invoice_number');
            $table->date('purchase_date');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('tax_percent', 5, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('shipping_charge', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->decimal('due_amount', 10, 2)->default(0);
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('remarks');
            $table->enum('is_deleted',['0','1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase');
    }
};
