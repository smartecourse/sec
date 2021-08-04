<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KelasAktif;
use App\Models\MateriKontenSelesai;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Transaksi;

class DashboardUserController extends Controller
{
    private $param;

    public function index()
    {
        if(!Session::has('token')) {
            // belum login
            return redirect('login');
        }
        try {
            $this->param['kelas'] = KelasAktif::select('kelas_aktif.*', 'kelas.slug', 'kelas.judul_kelas', 'kelas.tipe_kelas',)
                                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                                ->where('kelas_aktif.user_id', Session::get('id_user'))
                                                ->where('kelas_aktif.is_active', 'active')
                                                ->orderBy('updated_at', 'DESC')
                                                ->get();
            // return $this->param['kelas'];
            // $this->param['progres'] = MateriKontenSelesai::where('kelas_aktif_id', $this->param['kelas']->id)->count();
            
            return view('frontend.dashboard.dashboard-user', $this->param);
        }
        catch(\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function profil()
    {
        $this->param['profil'] = User::find(Session::get('id_user'));
        return view('frontend.dashboard.edit-profil', $this->param);
    }

    public function listTransaksi()
    {
        try {
            $this->param['data'] = Transaksi::select('transaksi.*', 'paket.nama_paket', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('paket', 'paket.id', 'transaksi.paket_id')
                                        ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                        ->where('transaksi.user_id', Session::get('id_user'))
                                        ->orderBy('kode_transaksi', 'ASC')
                                        ->get();

            return view('frontend.dashboard.list-transaksi', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
