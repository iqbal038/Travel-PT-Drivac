<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('no_pemesanan');
            $table->string('nama_pemesan');
            $table->string('no_telp');
            $table->timestamp('tanggal_pemesanan');
            $table->integer('jumlah_pemesanan');
            $table->unsignedBigInteger('id_tujuan');
            $table->unsignedBigInteger('id_supir');
            $table->unsignedBigInteger('id_user');
            $table->enum('status', ['belum-lunas', 'lunas'])->nullable();

            $table->foreign('id_supir')->references('id')->on('supir')->onDelete('NO ACTION');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('NO ACTION');

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
        Schema::dropIfExists('pemesanans');
    }
}
