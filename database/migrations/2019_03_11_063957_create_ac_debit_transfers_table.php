<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcDebitTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_debit_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ac_name');
            $table->string('transfer_id');
            $table->string('transfer_to');
            $table->string('ac_number')->nullable();
            $table->string('ac_description');
            $table->string('ac_amount')->nullable();        
            $table->string('ac_date');
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
        Schema::dropIfExists('ac_debit_transfers');
    }
}
