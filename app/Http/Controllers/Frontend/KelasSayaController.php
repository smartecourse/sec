<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\KelasAktif;
use App\Models\MateriKonten;
use App\Models\MateriKontenSelesai;
use App\Models\ReviewKelas;
use Illuminate\Http\Request;

class KelasSayaController extends Controller
{
    private $param;

    public function index()
    {
        if(!Session::has('token')) {
            // belum login
            return redirect('login');
        }
        try {
            $this->param['kelas'] = KelasAktif::select(
                                                    'kelas_aktif.*',
                                                    'kelas.tipe_kelas',
                                                    'kelas.slug',
                                                    'paket.id AS paket_id',
                                                    'paket.nama_paket',
                                                    'paket.cover',
                                                    'paket.updated_at',
                                                    'kelas_jenis.nama_jenis_kelas',
                                                    'kelas_jenis.deskripsi',

                                                )
                                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                                ->join('paket', 'paket.id', 'kelas.paket_id')
                                                ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                                ->where('kelas_aktif.user_id', Session::get('id_user'))
                                                ->where('kelas_aktif.is_active', 'active')
                                                ->orderBy('kelas_aktif.updated_at', 'DESC')
                                                ->groupBy('paket_id')
                                                ->get();
            // return $this->param['kelas'];
            // $this->param['progres'] = MateriKontenSelesai::where('kelas_aktif_id', $this->param['kelas']->id)->count();
            
            return view('frontend.dashboard.kelas-saya', $this->param);
        }
        catch(\Exception $e) {
            return $e;
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    // kelas aktif Ebook
    public function detailAktif($slug)
    {
        try {
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif', 'kelas.pdf_file')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();

            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'ebook')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;

            $kontenMateri = MateriKonten::where('materi_id', $this->param['materi'][0]->id)->first();

            $this->param['konten'] = MateriKonten::where('slug', $kontenMateri->slug)->where('urutan', $kontenMateri->urutan)->first();
                                                            // return $this->param['kelas'];
            return redirect('dashboard/detail-kelas-aktif-ebook'.'/'.$kelas->slug.'/'.$kontenMateri->slug.'/'.$kontenMateri->urutan.'/1');
            /* return view('frontend.dashboard.dashboard-kelas-aktif.ebook-kelas-aktif', $this->param); */
        }
        catch(\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function goMateriEbook($slug, $slug_materi, $urutan)
    {
        try {
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif', 'kelas.pdf_file')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();

            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'ebook')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;

            $this->param['konten'] = MateriKonten::where('slug', $slug_materi)->where('urutan', $urutan)->first();

            return view('frontend.dashboard.dashboard-kelas-aktif.ebook-kelas-aktif', $this->param);
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    // Kelas aktif video
    public function detailAktifVideo($slug)
    {
        try {
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();

            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'video')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;
            // return $kelas;

            $kontenMateri = MateriKonten::where('materi_id', $this->param['materi'][0]->id)->first();
            $this->param['konten'] = MateriKonten::where('slug', $kontenMateri->slug)->where('urutan', $kontenMateri->urutan)->first();
            $this->param['getExplode'] = explode('=', $this->param['konten']->konten);
            $this->param['getExplodeKonten'] = $this->param['getExplode'][1];

            /* dd($kontenMateri); */

            /* return view('frontend.dashboard.dashboard-kelas-aktif.video-kelas-aktif', $this->param); */
            return redirect('dashboard/detail-kelas-aktif-video'.'/'.$kelas->slug.'/'.$kontenMateri->slug.'/'.$kontenMateri->urutan.'/1');
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    public function goMateriVideo($slug, $slug_materi, $urutan)
    {
        try {
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();

            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'video')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;

            $this->param['konten'] = MateriKonten::where('slug', $slug_materi)->where('urutan', $urutan)->first();

            return view('frontend.dashboard.dashboard-kelas-aktif.video-kelas-aktif', $this->param);
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function goMateriVideoDone($slug, $slug_materi, $urutan, Request $request)
    {
        try {
            $getNextLink = $request->get('segment');
            $getKelasAktif = KelasAktif::select('kelas_aktif.id as id_kelas_aktif','kelas.id as id_kelas', 'kelas.slug as slug_kelas')
            ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
            ->where('kelas.slug', $slug)
            ->where('kelas_aktif.user_id', Session::get('id_user'))
            ->first();
            /* dd($getKelasAktif->id_kelas_aktif); */
            $getMateriKonten = MateriKonten::select('materi_konten.id')
            ->join('materi', 'materi.id', 'materi_konten.materi_id')
            ->join('kelas', 'kelas.id', 'materi.kelas_id')
            ->where('materi_konten.slug', $slug_materi)
            ->first();
            /* dd($getMateriKonten->id); */
            $materiSudah = MateriKontenSelesai::where('kelas_aktif_id', $getKelasAktif->id_kelas_aktif)
                                                ->where('materi_konten_id', $getMateriKonten->id)
                                                ->count();

            if($materiSudah > 0) {
                return redirect()->back()->withError('Materi sudah pernah ditandai.');
            }
            else {
                $newDone = new MateriKontenSelesai;
                $newDone->kelas_aktif_id = $getKelasAktif->id_kelas_aktif;
                $newDone->materi_konten_id = $getMateriKonten->id;
                $newDone->save();
            }
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();
            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'video')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;

            $this->param['konten'] = MateriKonten::where('slug', $slug_materi)->where('urutan', $urutan)->first();

            return redirect($getNextLink);
            /* return view('frontend.dashboard.dashboard-kelas-aktif.video-kelas-aktif', $this->param); */

            // return view('frontend.dashboard.dashboard-kelas-aktif.video-kelas-aktif');
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function goMateriEbookDone($slug, $slug_materi, $urutan, Request $request)
    {
        try {
            $getNextLink = $request->get('segment');
            $getKelasAktif = KelasAktif::select('kelas_aktif.id as id_kelas_aktif','kelas.id as id_kelas', 'kelas.slug as slug_kelas')
            ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
            ->where('kelas.slug', $slug)
            ->where('kelas_aktif.user_id', Session::get('id_user'))
            ->first();
            /* dd($getKelasAktif->id_kelas_aktif); */
            $getMateriKonten = MateriKonten::select('materi_konten.id')
            ->join('materi', 'materi.id', 'materi_konten.materi_id')
            ->join('kelas', 'kelas.id', 'materi.kelas_id')
            ->where('materi_konten.slug', $slug_materi)
            ->first();
            /* dd($getMateriKonten->id); */

            $materiSudah = MateriKontenSelesai::where('kelas_aktif_id', $getKelasAktif->id_kelas_aktif)
                                                ->where('materi_konten_id', $getMateriKonten->id)
                                                ->count();

            if($materiSudah > 0) {
                return redirect()->back()->withError('Materi sudah pernah ditandai.');
            }
            else {
                $newDone = new MateriKontenSelesai();
                $newDone->kelas_aktif_id = $getKelasAktif->id_kelas_aktif;
                $newDone->materi_konten_id = $getMateriKonten->id;
                $newDone->save();
            }
            $kelas = KelasAktif::select('kelas.id', 'kelas.slug', 'kelas_aktif.id AS id_kelas_aktif', 'kelas.pdf_file')
                                ->join('kelas', 'kelas.id', 'kelas_aktif.kelas_id')
                                ->where('kelas.slug', $slug)
                                ->first();

            $this->param['materi'] = \App\Models\Materi::select('materi.*', 'kelas.tipe_kelas')
                                                            ->join('kelas', 'kelas.id', 'materi.kelas_id')
                                                            ->where('materi.kelas_id', $kelas->id)
                                                            ->where('kelas.tipe_kelas', 'ebook')
                                                            ->orderBy('materi.urutan', 'ASC')
                                                            ->get();
            $this->param['kelas'] = $kelas;
            $this->param['konten'] = MateriKonten::where('slug', $slug_materi)->where('urutan', $urutan)->first();

            return redirect($getNextLink);

        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    // review Kelas
    public function reviewKelas(Request $request)
    {
        if(!Session::has('token')) {
            // belum login
            return redirect('login');
        }
        try{
            $id_user = Session::get('id_user');
            $addReview = new ReviewKelas;
            $addReview->id_user = $id_user;
            $addReview->id_kelas = $request->get('id_kelas');
            $addReview->rating = $request->get('rate');
            $addReview->review = $request->get('ulasan');
            $addReview->save();
            return redirect()->back();
        }catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
            
        
    }

}
