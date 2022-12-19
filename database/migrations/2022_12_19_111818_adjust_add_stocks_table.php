<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('add_stocks', function (Blueprint $table) {
            $table->string('id')->change();
            $table->dropColumn('qty');
            $table->dropColumn('purchase_price');
            $table->dropColumn('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('add_stocks', function (Blueprint $table) {
            $table->integer('qty');
            $table->integer('purchase_price');
            $table->unsignedBigInteger('product_id');
        });
    }
};
