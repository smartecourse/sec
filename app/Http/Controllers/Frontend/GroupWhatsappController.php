<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KelasAktif;
use App\Models\Kelas;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GroupWhatsappController extends Controller
{
    private $param;

    public function index()
    {

        $kelasAktif = KelasAktif::where('user_id', Session::get('id_user'))->where('is_active', 'active')->first();

        // $this->param['kelas'] = Kelas::select('kelas.id AS id_kelas', 'kelas.kode_kelas', 'kelas.judul_kelas','kelas.slug AS slug_kelas','kelas.tipe_kelas','kelas.by_author', 'kelas.is_active',
        //                                 'paket.id AS id_paket','paket.nama_paket','paket.slug AS slug_paket','paket.kelas_jenis_id','paket.cover','paket.deadline','paket.link_zoom','paket.group_whatsapp',
        //                                 'kelas_jenis.id','kelas_jenis.nama_jenis_kelas')
        //                                 ->join('paket','kelas.paket_id', 'paket.id')
        //                                 ->join('kelas_jenis','paket.kelas_jenis_id','kelas_jenis.id')
        //                                 ->groupBy('kelas_jenis.nama_jenis_kelas')
        //                                 ->get();

        if($kelasAktif != null) {
            $this->param['paket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas', 'kelas_jenis.deskripsi AS deskripsi_jenis')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->join('kelas','kelas.paket_id','paket.id')
                                        ->where('kelas.id', $kelasAktif->kelas_id)
                                        ->groupBy('paket.nama_paket')
                                        ->first();
        }
        else {
            $this->param['paket'] = null;
        }

    //    return $this->param['paket'];
       return view('frontend.dashboard.grup-whatsapp', $this->param);
    }
}
