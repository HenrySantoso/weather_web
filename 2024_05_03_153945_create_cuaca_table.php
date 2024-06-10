<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuacaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuaca', function (Blueprint $table) {
            $table->bigIncrements('CuacaID');
            $table->date('Tanggal');
            $table->string('NamaKota');
            $table->string('KondisiCuaca');
            $table->decimal('Suhu', 5, 2)->nullable()->default(0.00);
            $table->decimal('Kelembaban', 5, 2)->nullable()->default(0.00);
            $table->decimal('KecepatanAngin', 5, 2)->nullable()->default(0.00);
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
        Schema::dropIfExists('cuaca');
    }
}
