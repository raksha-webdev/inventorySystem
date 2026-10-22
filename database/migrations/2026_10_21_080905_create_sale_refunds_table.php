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
        Schema::create('sale_refunds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales_master')->onDelete('cascade');
            $table->decimal('refund_amount', 12, 2);
            $table->string('refund_method');
            $table->string('refund_status')->default('pending');
            $table->string('transaction_reference')->nullable();
            $table->string('refund_reason')->nullable();
            $table->string('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_refunds');
    }
};
