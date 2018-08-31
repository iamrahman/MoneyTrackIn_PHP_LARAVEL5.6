<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->string("username", 255);
            $table->string("email", 255);
            $table->boolean("gender");
            $table->string("password", 255);
            $table->string("dob", 255);
            $table->tinyInteger("language_id");
            $table->tinyInteger("currency_id");
            $table->integer("country");
            $table->string("place", 255)->nullable();
            $table->boolean("receive_mail_notify")->nullable();
            $table->tinyInteger("maritial_status");
            $table->tinyInteger("employment_id");
            $table->boolean("account_status");
            $table->string("photo", 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
