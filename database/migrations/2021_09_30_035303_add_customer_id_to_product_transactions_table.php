<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerIdToProductTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->after('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_transactions', function (Blueprint $table) {
            $table->dropForeign('product_transactions_customer_id_foreign');
            $table->dropColumn('customer_id');
        });
    }
}
