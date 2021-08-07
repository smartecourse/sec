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

    public function index(Request $request)
    {
        try {
            $dari = $request->get('dari');
            $sampai = $request->get('sampai');
            $transaksi = Transaksi::select('transaksi.*', 'users.nama', 'paket.nama_paket', 'paket.harga', 'kelas_jenis.nama_jenis_kelas')
                                                    ->join('users', 'users.id', 'transaksi.user_id')
                                                    ->join('paket', 'paket.id', 'transaksi.paket_id')
                                                    ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id');
                                                    
            if(isset($request->dari) || isset($request->sampai)) {
                $this->validate($request, [
                    'dari' => 'required',
                    'sampai' => 'required',
                ], [
                    'required' => ':attribute harus dipilih.'
                ], [
                    'dari' => 'Tanggal',
                    'sampai' => 'Tanggal'
                ]);

                $start = date('Y-m-d', strtotime($dari));
                $end = date('Y-m-d', strtotime($sampai));                
                
                $transaksi->whereBetween('transaksi.updated_at', [$start, $end])->orderBy('transaksi.kode_transaksi', 'ASC')->get();
            }
            else {
                $transaksi->orderBy('transaksi.kode_transaksi', 'ASC');
            }

            $this->param['listTransaksi'] = $transaksi->get();

            return view('admin.page.transaksi.transaksi', $this->param);
        }
        catch(\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : '.$e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function filterByDate()
    {
        
    }
}
