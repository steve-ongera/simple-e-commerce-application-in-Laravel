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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('sales_count')->default(0);
            $table->boolean('is_sponsored')->default(false);
            $table->boolean('is_valentine')->default(false);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sales_count');
            $table->dropColumn('is_sponsored');
            $table->dropColumn('is_valentine');
        });
    }
};
