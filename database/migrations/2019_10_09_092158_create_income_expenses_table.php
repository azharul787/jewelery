<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_expenses', function (Blueprint $table) {
            /*$table->bigIncrements('id');
            $table->timestamps();*/
            $table->integer('user_id');
            $table->date('transaction_date');
            $table->string('description');
            $table->decimal('income_amount')->nullable();
            $table->decimal('expense_amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_expenses');
    }
}
