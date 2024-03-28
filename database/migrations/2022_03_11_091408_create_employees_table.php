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
            $table->string('NIP')->unique();
            $table->year('tahun_lahir');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('agama');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->text('path_image');
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