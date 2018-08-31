<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PeriodicTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodicTransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('account_name', 255);
            $table->string('tags', 255);
            $table->integer('amount');
            $table->integer('duration');
            $table->integer('duration_left');
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
        Schema::dropIfExists('periodicTransactions');
    }
}
