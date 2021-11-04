<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitIdColumnToProductSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sale_items', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id')->after('brand_id');

            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropForeign('product_sale_items_unit_id_foreign');
            $table->dropColumn('unit_id');
        });
    }
}
