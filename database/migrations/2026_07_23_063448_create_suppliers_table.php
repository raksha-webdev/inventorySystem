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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('contact_person')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('gst_number')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('pin_code');
            $table->boolean('status')->default(1);
            $table->string('supplier_code')->unique();
            $table->string('alternate_phone')->nullable();
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
