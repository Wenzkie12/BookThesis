<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department');   
            $table->string('year_level', 10); 
            $table->string('section');        
            $table->timestamps();
            $table->unique(['department', 'year_level', 'section']);
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
