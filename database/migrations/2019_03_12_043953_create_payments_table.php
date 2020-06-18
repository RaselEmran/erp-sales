<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ac_date');
            $table->string('description');
            $table->string('root_acc');
            $table->string('customer')->nullable();
            $table->string('supplier')->nullable();
            $table->string('office')->nullable();
            $table->string('loan_name')->nullable();
            $table->string('mode')->nullable();
            $table->string('amount');
            $table->string('check_num')->nullable();
            $table->string('check_date')->nullable();
            $table->string('bank_name')->nullable(); 
            $table->string('payment_type')->nullable();            
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
        Schema::dropIfExists('payments');
    }
}
