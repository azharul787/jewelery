<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->unique();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->decimal('gross_price',10,2);
            $table->decimal('per_rote_price',10,2);
            $table->decimal('total_weight',10,2)->nullable();
            $table->decimal('total_wage',10,2)->nullable();
            $table->decimal('total_price',10,2);
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->decimal('payment',10,2);
            $table->decimal('due_amount',10,2);
            $table->string('note')->nullable();
            $table->date('order_date');
            $table->date('delivery_date');
            $table->string('status')->default("Pending");
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
