
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            // string to text
            $table->text('message')->change();

            // string to boolean
            $table->boolean('is_read')->default(false)->change();

        });
    }

    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {

            // text to string
            $table->string('message', 255)->change();

            // boolean to string
            $table->string('is_read')->default('0')->change();

        });
    }
};
