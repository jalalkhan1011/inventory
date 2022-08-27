<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('product_sale_id')->nullable();
            $table->string('access_user')->nullable();
            $table->unsignedBigInteger('access_user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('amount',8,2);
            $table->string('product_status')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('product_sale_id')->references('id')->on('product_sales')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
