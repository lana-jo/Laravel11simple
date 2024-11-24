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
        $table->string('status')->default('borrowed');  // Menambahkan kolom status
    });
}

public function down()
{
    Schema::table('borrowing_items', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
