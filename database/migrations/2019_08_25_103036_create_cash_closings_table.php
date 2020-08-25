<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_closings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('closing_date');
            $table->decimal('lastday_balance',10,2);
            $table->decimal('receipt',10,2);
            $table->decimal('payment',10,2);
            $table->decimal('balance',10,2);
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
        Schema::dropIfExists('cash_closings');
    }
}
