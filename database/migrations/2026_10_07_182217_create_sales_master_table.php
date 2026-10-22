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
        Schema::create('sales_master', function (Blueprint $table) {
            $table->id();
            
        $table->string('customer_name');
        $table->string('customer_mobile_number', 15)->nullable();
        $table->text('customer_address')->nullable();

        $table->date('purchase_date');
        $table->string('invoice_number')->unique();

        $table->decimal('sub_total', 12, 2)->default(0);
        $table->decimal('discount', 12, 2)->default(0);
        $table->decimal('grand_total', 12, 2)->default(0);

        $table->tinyInteger('status')->default(1);

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_master');
    }
};
