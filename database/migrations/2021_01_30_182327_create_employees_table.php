<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 250);
            $table->string('last_name', 250);
            $table->bigInteger('company_id')->unsigned()->index();            
            $table->string('email', 250)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('designation', 250)->nullable();
            $table->string('status', 20)->nullable();            
            $table->timestamps();
        });

        Schema::table('employees', function($table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
