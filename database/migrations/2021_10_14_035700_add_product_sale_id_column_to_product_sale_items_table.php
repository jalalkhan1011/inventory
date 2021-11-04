<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductSaleIdColumnToProductSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sale_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_sale_id')->after('total_item_price');

            $table->foreign('product_sale_id')->references('id')->on('product_sales')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_sale_items', function (Blueprint $table) {
            $table->dropForeign('product_sale_items_product_sale_id_foreign');
            $table->dropColumn('product_sale_id');
        });
    }
}
