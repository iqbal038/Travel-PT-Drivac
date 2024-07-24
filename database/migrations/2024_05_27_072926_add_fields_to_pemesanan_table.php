<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPemesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->string('lokasi_penjemputan')->nullable()->after('jumlah_pemesanan');
            $table->string('lat_penjemputan')->nullable()->after('lokasi_penjemputan');
            $table->string('lng_penjemputan')->nullable()->after('lat_penjemputan');
            $table->string('lokasi_tujuan')->nullable()->after('lng_penjemputan');
            $table->string('lat_tujuan')->nullable()->after('lokasi_tujuan');
            $table->string('lng_tujuan')->nullable()->after('lat_tujuan');
            $table->float('total_jarak')->nullable()->after('lng_tujuan');
            $table->float('harga_pesanan')->nullable()->after('total_jarak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn('lokasi_penjemputan');
            $table->dropColumn('lat_penjemputan');
            $table->dropColumn('lng_penjemputan');
            $table->dropColumn('lokasi_tujuan');
            $table->dropColumn('lat_tujuan');
            $table->dropColumn('lng_tujuan');
            $table->dropColumn('total_jarak');
            $table->dropColumn('harga_pesanan');
        });
    }
}
