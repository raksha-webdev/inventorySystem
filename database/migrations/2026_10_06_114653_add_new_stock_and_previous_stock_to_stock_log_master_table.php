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
        Schema::table('stock_log_master', function (Blueprint $table) {
            $table->integer('new_stock')->default(0);
            $table->integer('previous_stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_log_master', function (Blueprint $table) {
            $table->dropColumn(['new_stock', 'previous_stock']);

        });
    }
};
