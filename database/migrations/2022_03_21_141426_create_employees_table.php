<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->dateTime('date_birth');
            $table->string('father')->nullable();
            $table->string('mother');
            $table->string('naturalness')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('sex')->nullable();
            $table->string('color')->nullable();
            $table->string('phone')->nullable();
            $table->string('certificate_type')->nullable();
            $table->string('certificate_term')->nullable();
            $table->string('certificate_book')->nullable();
            $table->string('certificate_sheet')->nullable();
            $table->string('address')->nullable();
            $table->string('cep')->nullable();
            $table->string('rg')->nullable();
            $table->dateTime('rg_expedition')->nullable();
            $table->string('cpf')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_agency')->nullable();
            $table->string('bank_number')->nullable();
            $table->string('schooling')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_status')->nullable();
            $table->string('name_college')->nullable();
            $table->string('conclusion')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
