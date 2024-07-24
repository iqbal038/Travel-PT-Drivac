<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;
session_id('travel-iqbal');
session_start();

class TransaksiController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_pembayaran' => 'required'
        ]);
        
        $status = Transaksi::create([
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'tanggal_pembayaran' => NOW(),
            'no_pemesanan' => $request->no_pemesanan
        ]);
        
        if($status)
        {
            return redirect()->to('riwayat-transaksi')->with('success', 'Pembayaran berhasil dilakukan.');
        } else {
            return redirect()->to('riwayat-transaksi')->with('success', 'Pembayaran gagal dilakukan.');
        }
    }

    public function pembayaran(Request $request)
    {

        $data = [];


        if ($request->no_pemesanan != "") {
            // $data = Pemesanan::join("tujuan", "tujuan.id", '=', "pemesanan.tujuan")
            //     ->where('pemesanan.id', '=', $request->no_pemesanan)
            //     ->select(["pemesanan.id", "pemesanan.nama_pemesan", "pemesanan.no_pemesanan", "pemesanan.tanggal_pemesanan", "pemesanan.jumlah_pemesanan", "tujuan.tujuan", "tujuan.harga"])
            //     ->first();

            $data = Pemesanan::join('tujuan', 'tujuan.id', '=', 'pemesanan.tujuan')
            ->where('pemesanan.no_pemesanan', $request->no_pemesanan)
            ->get(['pemesanan.*', 'tujuan.tujuan','tujuan.harga'])->first();

        }

        return view('pages.pembayaran')->with(['pemesanan' => $data]);
    }
    public function riwayat_transaksi()
    {
        $pemesanan = DB::table('pemesanan as a')
            ->join('tujuan as b', 'a.id_tujuan', '=', 'b.id')
            ->select('a.*', 'b.tujuan')
            ->where('a.id_user', Auth::user()->id)
            ->get();
            
        $pembayaran = DB::table('pemesanan as a')
                ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
                ->join('tujuan as c', 'a.id_tujuan', '=', 'c.id')
                ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'c.tujuan')
                ->where('a.id_user', Auth::user()->id)
                ->get();
                
        return view('pages.riwayat-transaksi', compact('pemesanan', 'pembayaran'));
    }

    public function getPemesanan(Request $request)
    {
        $no_pemesanan = $request->input('no_pemesanan');

        $data = DB::table('pemesanan as a')
            ->join('tujuan as b', 'a.id_tujuan', '=', 'b.id')
            ->select('a.*', 'b.tujuan', 'b.harga')
            ->where('a.status', '=', 'belum-lunas')
            ->where('a.id_user', '=', Auth::user()->id)
            ->where('a.no_pemesanan', '=', $no_pemesanan)
            ->first();

        if($data)
        {
            return response()->json([
                'status' => 'success',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nomor Pemesanan tidak ditemukan.'
            ], 404);
        }
    }
}
