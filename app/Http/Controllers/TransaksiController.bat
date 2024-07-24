<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function form_pemesanan() {
        return view('pages.pemesanan');
    }

    public function form_pembayaran() {
        return view('pages.pembayaran');
    }

    public function riwayat_transaksi() {
        return view('pages.riwayat-transaksi');
    }
}
