<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporan() {
        return view('pages.laporan');
    }

    public function laporan_cetak() {
        $dari_tgl = $_GET['dari-tgl'];
        $sampai_tgl = $_GET['sampai-tgl'];

        return view('pages.laporan-cetak', compact('dari_tgl', 'sampai_tgl'));
    }
}
