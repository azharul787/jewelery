<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('worker_order_id')->unsigned()->nullable();
            $table->date('payment_date');
            $table->decimal('amount',10,2);
            $table->string('note')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('worker_order_id')->references('id')->on('worker_orders')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('worker_accounts');
    }
}
