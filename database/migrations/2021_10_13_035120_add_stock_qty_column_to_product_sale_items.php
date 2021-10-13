<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockQtyColumnToProductSaleItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_sale_items', function (Blueprint $table) {
            $table->float('stock_qty',8,2)->after('brand_id');
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
            $table->dropColumn('stock_qty');
        });
    }
}
