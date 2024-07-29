<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
class LaporanController extends Controller
{

    public function laporan()
    {
        return view('pages.laporan');
    }

    public function laporan_cetak(Request $request)
    {
        $dari_tgl = $request->dari_tgl;
        $sampai_tgl = $request->sampai_tgl;

        $data = DB::table('pemesanan as a')
            ->leftJoin('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
            ->leftJoin('supir as c', 'a.id_supir', '=', 'c.id')
            ->leftJoin('users as d', 'a.id_user', '=', 'd.id')
            ->select('a.*', 'b.jenis_pembayaran',    'b.jumlah_pembayaran', 'b.tanggal_pembayaran', 'c.nama_supir')
            ->whereBetween('a.tanggal_pemesanan', [$dari_tgl, $sampai_tgl])
            ->get();
        // dd($pemesanan);
        $pdf = PDF::loadview('pages.laporan-cetak', compact('dari_tgl', 'sampai_tgl','data'))->setPaper('A4', 'landscape');
        return $pdf->download('invoice.pdf');
        // return view('pages.laporan-cetak', compact('dari_tgl', 'sampai_tgl','data'));
    }
}
