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
        Schema::create('stock_log_master', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('product_id');

            $table->enum('transaction_type', ['increase', 'decrease']);
    
            $table->integer('quantity');
    
            $table->string('reason')->nullable();
    
            $table->timestamp('transaction_date')->useCurrent();
    
            $table->enum('status', ['active', 'deactive'])->default('active');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_log_master');
    }
};
