<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBondStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bond_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('box_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->integer('entry_year')->nullable();
            $table->integer('exit_year');
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
        Schema::dropIfExists('bond_students');
    }
}
