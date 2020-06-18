<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer_name');
            $table->string('pos_date');
            $table->string('sub_total');
            $table->string('discount')->nullable();
            $table->string('percent')->nullable();
            $table->string('percent_amt')->nullable();

            $table->string('net_total');
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('status');
            $table->string('delete')->default(1);

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
        Schema::dropIfExists('pos');
    }
}
