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
    Schema::table('borrowing_items', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->change();  // Membuat user_id opsional
    });
}

public function down()
{
    Schema::table('borrowing_items', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable(false)->change();  // Menyimpan agar user_id tidak nullable
    });
}

};
