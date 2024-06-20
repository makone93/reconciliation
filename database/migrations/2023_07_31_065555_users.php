<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('user_id')->autoIncrement();
            $table->string('f_name', 30);
            $table->string('l_name', 30);
            $table->string('nat_id', 13)->nullable();
            $table->string('gender', 6)->default('Male');
            $table->string('phone', 12)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('company_no', 10)->nullable();
            $table->integer('department_id')->nullable();
            $table->boolean('department_head')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('user_type_id');
            $table->string('username', 20)->nullable();
            $table->string('password', 255)->nullable();
            $table->timestamps();

            // foreign keys
            $table->foreign('department_id')->references('department_id')->on('departments')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('user_type_id')->references('user_type_id')->on('user_types')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
