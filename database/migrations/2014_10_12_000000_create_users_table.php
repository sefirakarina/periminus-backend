<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken()->nullable();
            $table->string('role');
            //$table->timestamps();
            $table->string('cus_gender',10)->nullable();
            $table->date('cus_dob')->nullable();
            $table->string('cus_phone',30)->nullable();
            $table->string('cus_address',150)->nullable();
            $table->string('cc_num',20)->nullable();
            $table->string('cc_type',10)->nullable();
            $table->string('cc_name',50)->nullable();
            $table->integer('cc_exmonth')->nullable();
            $table->integer('cc_exyear')->nullable();
            $table->integer('cc_cvv')->nullable();
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
