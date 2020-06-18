<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDueInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('due_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_id');
            $table->string('net_total');
            $table->string('pay_amt');
            $table->string('due_amt');
            $table->string('date');


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
        Schema::dropIfExists('due_infos');
    }
}
