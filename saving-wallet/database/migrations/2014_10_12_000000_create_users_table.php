<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->unique();
            $table->string('birth_date')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('role')->index()->default(1);  // Note:- User = 1 , admin = 2   (tiny integer with index for for speed retrieve data and better performance )
            $table->string('password');
            $table->integer('total_expenses')->nullable();
            $table->integer('total_income')->nullable();
            $table->integer('wallet_balance')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
