<?php

namespace App\Http\Controllers;

use App\Models\JenisKelas;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class TransaksiController extends Controller
{
    private $param;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->param['listTransaksi'] = Transaksi::select('transaksi.*', 'users.nama', 'paket.nama_paket', 'paket.harga', 'kelas_jenis.nama_jenis_kelas')
                                                    ->join('users', 'users.id', 'transaksi.user_id')
                                                    ->join('paket', 'paket.id', 'transaksi.paket_id')
                                                    ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                                    ->orderBy('kode_transaksi', 'ASC')
                                                    ->get();

            return view('admin.page.transaksi.transaksi', $this->param);
        }
        catch(\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan');
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function checkout($id)
    // {
    //     $transaksi = Transaksi::select('transaksi.*', 'users.nama', 'users.email', 'paket.nama_paket')
    //                             ->join('users', 'users.id', 'transaksi.user_id')
    //                             ->join('paket', 'paket.id', 'transaksi.paket_id')
    //                             ->find($id);

    //     // Set konfigurasi midtrans
    //     Config::$serverKey = config('midtrans.serverKey');
    //     Config::$isProduction = config('midtrans.isProduction');
    //     Config::$isSanitized = config('midtrans.isSanitized');
    //     Config::$is3ds = config('midtrans.is3ds');

    //     // Deklarasi array untuk dikirim ke midtrans
    //     $midtrans_params = [
    //         'transaction_details' => [
    //             'order_id' => $transaksi->kode_transaksi,
    //             'gross_amount' => (int) $transaksi->grand_total,
    //         ],
    //         'customer_details' => [
    //             'first_name' => $transaksi->nama,
    //             'email' => $transaksi->email
    //         ],
    //         'item_details' => array(
    //             array(
    //                 'id' => (string) $transaksi->paket_id,
    //                 'price' => (int) $transaksi->grand_total,
    //                 'quantity' => 1,
    //                 'name' => $transaksi->nama_paket
    //             )
    //         ),
    //         // 'enabled_payments' => ['gopay'],
    //         'enabled_payments' => ['cimb_clicks',
    //             'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va',
    //             'bca_va', 'bni_va', 'bri_va', 'other_va', 'gopay', 'indomaret',
    //             'danamon_online', 'akulaku', 'shopeepay'],
    //         'vtweb' => []
    //     ];

    //     // return $midtrans_params;


    //     try {
    //         // Ambil halaman payment midtrans
    //         $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

    //         // Redirect to Snap Payment Page
    //         return redirect($paymentUrl);

    //     } catch (\Exception $e) {
    //         $response = $e->getMessage();
    //         return $response;
    //     }
    // }
}
