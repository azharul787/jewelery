<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('invoice_no')->unique()->unsigned();
            $table->decimal('total_price',10,2)->nullable();
            $table->decimal('weight',10,2)->nullable();
            $table->decimal('wage',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('grand_total_price',10,2)->nullable();   
            $table->decimal('payment',10,2)->nullable();
            $table->string('payment_by')->nullable();
            $table->integer('transaction_no')->nullable();
            $table->string('payment_status');
            $table->decimal('due_amount',10,2);
            $table->text('note')->nullable();
            $table->date('sale_date');
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
        Schema::dropIfExists('sales');
    }
}
