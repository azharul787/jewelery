<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sale_profit_percentage')->nullable();
            $table->integer('vat_percentage')->nullable();
            $table->decimal('per_10_gm_price',10,2)->nullable();
            $table->decimal('customer_wage_per_gram',10,2);
            $table->decimal('worker_wage_per_gram',10,2);
            $table->integer('ddspinp');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
