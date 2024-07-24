<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Pemesanan;
use App\Models\Supir;
use App\Models\Transaksi;
use App\Models\Tujuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Session;

session_id('travel-iqbal');
session_start();

class TransaksiController extends Controller
{

    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }
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
        $response = []; // Deklarasi variabel response

        DB::transaction(function () use ($request, &$response) { // Gunakan pass by reference untuk response
            $order_id = Uuid::uuid4()->toString();
            $pemesanan = Pemesanan::leftJoin('transaksi as b', 'pemesanan.no_pemesanan', '=', 'b.no_pemesanan')
            ->leftJoin('supir as c', 'pemesanan.id_supir', '=', 'c.id')
            ->leftJoin('users as d', 'pemesanan.id_user', '=', 'd.id')
            ->select('pemesanan.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran', 'b.tanggal_pembayaran', 'c.nama_supir', 'd.email')
            ->where('pemesanan.id', $request->id_pemesanan)
            ->first();



            $payload = [
                'transaction_details' => [
                    'order_id'     => $order_id,
                    'gross_amount' =>  $pemesanan->harga_pesanan,
                ],
                'customer_details' => [
                    'first_name' =>  $pemesanan->nama_pemesan,
                    'email'      =>  $pemesanan->email,
                ],
                'item_details' => [
                    [
                        'id'            =>  $pemesanan->no_pemesanan,
                        'quantity'      =>  1,
                        'price'         => $pemesanan->harga_pesanan, // Menghapus koma berlebih
                        'merchant_name' => config('app.name'),
                        'name'          => 'Payment to ' .  config('app.name'),
                        'brand'         => 'Payment',
                        'category'      => 'Payment',
                    ],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($payload);

            $pay = Payment::upsert([
                'jenis_pembayaran' => "MIDTRANS",
                'jumlah_pembayaran' => $pemesanan->harga_pesanan,
                'tanggal_pembayaran' => now(), // Menggunakan fungsi now() Laravel
                'no_pemesanan' => $pemesanan->no_pemesanan,
                'snap_token' => $snapToken,
            ],['no_pemesanan'],['snap_token']);
            
            if ($pemesanan) {
                $pemesanan->update(['status' => 'lunas']);
            }
            $response['snap_token'] = $snapToken; // Memperbarui response
            $response['no_pemesanan'] = $pemesanan->no_pemesanan;
            $response['order_id'] = $order_id;
        });


        return response()->json([
            'status'     => 'success',
            'snap_token' => $response, // Mengembalikan response yang telah diperbarui
        ]);
    }

    // dd($request->all());exit;
    // $status = Transaksi::create([
    //     'jenis_pembayaran' => $request->jenis_pembayaran,
    //     'jumlah_pembayaran' => $request->jumlah_pembayaran,
    //     'tanggal_pembayaran' => NOW(),
    //     'no_pemesanan' => $request->no_pemesanan
    // ]);

    // if($status)
    // {
    //     return redirect()->to('riwayat-transaksi')->with('success', 'Pembayaran berhasil dilakukan.');
    // } else {
    //     return redirect()->to('riwayat-transaksi')->with('success', 'Pembayaran gagal dilakukan.');
    // }


    public function pembayaran(Request $request, $tipe, $id)
    {

        $pemesanan = DB::table('pemesanan as a')
            ->leftJoin('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
            ->leftJoin('supir as c', 'a.id_supir', '=', 'c.id')
            ->leftJoin('users as d', 'a.id_user', '=', 'd.id')
            ->select('a.*', 'b.jenis_pembayaran',    'b.jumlah_pembayaran', 'b.tanggal_pembayaran', 'c.nama_supir')
            ->where('a.id', $id)
            ->first();
        // $data = Pemesanan::join('tujuan', 'tujuan.id', '=', 'pemesanan.tujuan')
        //         ->where('pemesanan.no_pemesanan', $request->no_pemesanan)
        //         ->get(['pemesanan.*', 'tujuan.tujuan', 'tujuan.harga'])->first();
        // $no_pemesanan = $this->noPemesananOtomatis();
        $supir = Supir::all();
        $tujuan = Tujuan::all();
        return view('pages.pembayaran', compact('pemesanan', 'supir', 'tujuan', 'tipe'));
    }
    public function riwayat_transaksi()
    {
        $pemesanan = DB::table('pemesanan as a')
            ->leftJoin('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
            ->select('a.*', 'b.jenis_pembayaran',    'b.jumlah_pembayaran', 'b.tanggal_pembayaran')
            ->where('a.id_user', Auth::user()->id)
            ->get();

        $pembayaran = DB::table('pemesanan as a')
            ->join('transaksi as b', 'a.no_pemesanan', '=', 'b.no_pemesanan')
            ->select('a.*', 'b.jenis_pembayaran', 'b.jumlah_pembayaran')
            ->where('a.id_user', Auth::user()->id)
            ->get();

        return view('pages.riwayat-transaksi', compact('pemesanan', 'pembayaran'));
    }

    public function getPemesanan(Request $request)
    {
        $no_pemesanan = $request->input('no_pemesanan');

        $data = DB::table('pemesanan as a')
            ->select('a.*')
            ->where('a.status', '=', 'belum-lunas')
            ->where('a.id_user', '=', Auth::user()->id)
            ->where('a.no_pemesanan', '=', $no_pemesanan)
            ->first();

        if ($data) {
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

    public function updatePaymentType(Request $request) {
        print_r($request->order_id);
        $checkTransactionStatus = \Midtrans\Transaction::status($request->order_id);
        Payment::where('no_pemesanan',$request->no_pemesanan)
        ->update(['jenis_pembayaran' => $checkTransactionStatus->payment_type]);

        return response()->json([
            'status' => 'success'
        ], 200);
    }
}
