<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Tujuan;
use App\Models\Supir;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use TheSeer\Tokenizer\Exception;

class PemesananController extends Controller
{
    private function noPemesananOtomatis()
    {
        $kode = "TRV" . date('Y') . '/';
        $currentKode = date('Y');
        $lastDigit = DB::table('pemesanan')
            ->select(DB::raw("IFNULL(MAX(SUBSTRING(no_pemesanan, 9, 6)), 0)+1 digit"))
            ->where(DB::raw("SUBSTRING(no_pemesanan, 4, 4)"), '=', $currentKode)
            ->first();
        $lastDigit = json_decode(json_encode($lastDigit), true);

        $kode .= sprintf("%04s", $lastDigit['digit']);

        return $kode;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // die;
        try {
            $status = Pemesanan::create([
                'nama_pemesan' => $request->nama_pemesan,
                'no_telp' => $request->no_telp,
                'no_pemesanan' => $this->noPemesananOtomatis(),
                'tanggal_pemesanan' => $request->tanggal_pemesanan,
                'jumlah_pemesanan' => $request->jumlah_pemesanan,
                // 'id_tujuan' => $request->id_tujuan,
                'id_supir' => $request->id_supir,
                'id_user' => Auth::user()->id,
                'status' => 'belum-lunas',
                'lokasi_penjemputan' => $request->lokasi_penjemputan,
                'lat_penjemputan' => $request->lat_penjemputan,
                'lng_penjemputan' => $request->lng_penjemputan,
                'lokasi_tujuan' => $request->lokasi_tujuan,
                'lat_tujuan' => $request->lat_tujuan,
                'lng_tujuan' => $request->lng_tujuan,
                'total_jarak' => $request->total_jarak,
                'harga_pesanan' => str_replace('.', '', $request->total_harga),
            ]);

            return redirect()->to('riwayat-transaksi/' . 'bayar/' . $status->id)->with('success', 'Pemesanan berhasil, silahkan lakukan pembayaran');
        } catch (Exception $e) {
            return redirect()->to('pemesanan')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemesanan $pemesanan)
    {
        //
    }
    public function pemesanan()
    {
        $no_pemesanan = $this->noPemesananOtomatis();
        $supir = Supir::all();
        $tujuan = Tujuan::all();
        return view('pages.pemesanan')->with(['supir' => $supir, 'tujuan' => $tujuan, 'no_pemesanan' => $no_pemesanan]);
    }
}
