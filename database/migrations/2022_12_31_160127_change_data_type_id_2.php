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
        Schema::dropIfExists('slides');

        Schema::table('attribute_options', function (Blueprint $table) {
            $table->dropForeign('attribute_options_attribute_id_foreign');
        });

        Schema::table('detail_add_stocks', function (Blueprint $table) {
            $table->dropForeign('detail_add_stocks_add_stock_id_foreign');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign('favorites_user_id_foreign');
            $table->dropForeign('favorites_product_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('orders_user_id_foreign');
            $table->dropForeign('orders_approved_by_foreign');
            $table->dropForeign('orders_cancelled_by_foreign');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign('order_items_order_id_foreign');
            $table->dropForeign('order_items_product_id_foreign');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign('payments_order_id_foreign');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_parent_id_foreign');
            $table->dropForeign('products_user_id_foreign');
        });

        Schema::table('product_attribute_values', function (Blueprint $table) {
            $table->dropForeign('product_attribute_values_parent_product_id_foreign');
            $table->dropForeign('product_attribute_values_product_id_foreign');
            $table->dropForeign('product_attribute_values_attribute_id_foreign');
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign('product_categories_product_id_foreign');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->dropForeign('product_images_product_id_foreign');
        });

        Schema::table('product_inventories', function (Blueprint $table) {
            $table->dropForeign('product_inventories_product_id_foreign');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign('shipments_user_id_foreign');
            $table->dropForeign('shipments_order_id_foreign');
            $table->dropForeign('shipments_shipped_by_foreign');
        });


        ////////////////////////////////////////////////////////

        Schema::table('add_stocks', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('supplier_id')->change();
            $table->uuid('user_id')->change();
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->uuid('id')->change();
        });

        Schema::table('attribute_options', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('attribute_id')->change();

            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->uuid('parent_id')->change();
        });

        Schema::table('detail_add_stocks', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('add_stock_id')->change();

            $table->foreign('add_stock_id')->references('id')->on('add_stocks')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('parent_id')->change();
            $table->uuid('supplier_id')->change();

            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('product_attribute_values', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('parent_product_id')->change();
            $table->uuid('product_id')->change();
            $table->uuid('attribute_id')->change();

            $table->foreign('parent_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
        
        Schema::table('product_categories', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('product_id')->change();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('product_id')->change();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('product_inventories', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('product_id')->change();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user_id')->change();
            $table->uuid('product_id')->change();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user_id')->change();
            $table->uuid('approved_by')->change();
            $table->uuid('cancelled_by')->change();
            $table->uuid('out_coming_stock_id')->change();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cancelled_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('order_id')->change();
            $table->uuid('product_id')->change();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::table('out_coming_stocks', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user_id')->change();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('order_id')->change();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });

        Schema::table('shipments', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user_id')->change();
            $table->uuid('order_id')->change();
            $table->uuid('shipped_by')->change();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('shipped_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->uuid('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
