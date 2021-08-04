<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MateriKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontenMateriController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'materi-konten';
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['listMateriKonten'] = MateriKonten::select('materi.nama_materi', 'materi_konten.*', 'kelas.judul_kelas', 'kelas.tipe_kelas')
                                                        ->join('materi', 'materi_konten.materi_id', 'materi.id')
                                                        ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                                        ->orderBy('materi.id')
                                                        ->get();

        return view('admin.page.materi-konten.materi-konten', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['listMateri'] = Materi::select('materi.*', 'kelas.kode_kelas', 'kelas.judul_kelas', 'kelas.tipe_kelas', 'kelas_jenis.nama_jenis_kelas')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->join('paket', 'paket.id', 'kelas.paket_id')
                                            ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                            ->orderBy('kelas.kode_kelas', 'ASC')
                                            ->get();
        return view('admin.page.materi-konten.materi-konten-tambah', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'materi' => 'not_in:0',
                /* 'urutan_konten_materi' => 'required|array|numeric',
                'urutan_konten_materi.*' => 'required|numeric',
                'judul_konten_materi' => 'required|array|min:3|max:50',
                'judul_konten_materi.*' => 'required|string|min:3|max:50',
                'deskripsi' => 'required|array|min:20',
                'deskripsi.*' => 'required|string|min:20', */
            ],
            [
                'required' => ':attribute harus diisi.',
                'nama_materi.min' => 'Minimal panjang karakter 3.',
                'deskripsi.min' => 'Minimal panjang karakter 20.',
                'max' => 'Maksimal panjang karakter 50.',
                'unique' => ':attribute telah terdaftar.',
                'not_in' => ':attribute harus dipilih.',
                'numeric' => 'Karakter yang dimasukkan harus berupa angka.'
            ],
            [
                'materi' => 'Materi',
                /* 'urutan_konten_materi' => 'Urutan Konten Materi',
                'judul_konten_materi' => 'Judul Konten Materi',
                'deskripsi' => 'Deskripsi', */
            ]
        );
        try {
            $length = count($request->get('urutan_konten_materi'));

            for ($i=0; $i < $length ; $i++) { 
                $newKontenMateri = new MateriKonten();
                $newKontenMateri->materi_id = $request->get('materi');
                $newKontenMateri->judul_konten_materi = $request->get('judul_konten_materi')[$i];
                $newKontenMateri->slug = Str::slug($request->get('judul_konten_materi')[$i]);
                $newKontenMateri->deskripsi = $request->get('deskripsi')[$i];
                $newKontenMateri->konten = $request->get('konten')[$i];
                $newKontenMateri->urutan = $request->get('urutan_konten_materi')[$i];
                $newKontenMateri->save();
            };

            return redirect('master/konten-materi')->withStatus('Berhasil menambah data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->param['getMateri'] = MateriKonten::select('materi.nama_materi', 'materi_konten.*', 'kelas.kode_kelas', 'kelas.judul_kelas', 'kelas.tipe_kelas', 'kelas_jenis.nama_jenis_kelas')
                                                ->join('materi', 'materi_konten.materi_id', 'materi.id')
                                                ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                                ->join('paket', 'paket.id', 'kelas.paket_id')
                                                ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                                ->where('materi_konten.id', $id)
                                                ->first();

        return view('admin.page.materi-konten.materi-konten-detail', $this->param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->param['getKontenMateri'] = MateriKonten::findOrFail($id);
        $this->param['listMateri'] = Materi::select('materi.*', 'kelas.kode_kelas', 'kelas.judul_kelas', 'kelas.tipe_kelas', 'kelas_jenis.nama_jenis_kelas')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->join('paket', 'paket.id', 'kelas.paket_id')
                                            ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                            ->orderBy('kelas.kode_kelas', 'ASC')
                                            ->get();
        return view('admin.page.materi-konten.materi-konten-edit', $this->param);
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
        $this->validate($request, 
            [
                'materi' => 'not_in:0',
                'urutan_konten_materi' => 'required|numeric',
                'judul_konten_materi' => 'required|min:3|max:50',
                'deskripsi' => 'required|min:20',
            ],
            [
                'required' => ':attribute harus diisi.',
                'nama_materi.min' => 'Minimal panjang karakter 3.',
                'deskripsi.min' => 'Minimal panjang karakter 20.',
                'max' => 'Maksimal panjang karakter 50.',
                'unique' => ':attribute telah terdaftar.',
                'not_in' => ':attribute harus dipilih.',
                'numeric' => 'Karakter yang dimasukkan harus berupa angka.'
            ],
            [
                'materi' => 'Materi',
                'urutan_konten_materi' => 'Urutan Konten Materi',
                'judul_konten_materi' => 'Judul Konten Materi',
                'deskripsi' => 'Deskripsi',
            ]
        );
        try {
            $cekUrutan = MateriKonten::where('materi_id', $request->get('materi'))->where('urutan', $request->get('urutan_konten_materi'))->where('id', '!=', $id)->first();
            if (($cekUrutan == NULL)) {
                $newKontenMateri = MateriKonten::find($id);
                $newKontenMateri->materi_id = $request->get('materi');
                $newKontenMateri->judul_konten_materi = $request->get('judul_konten_materi');
                $newKontenMateri->slug = Str::slug($request->get('judul_konten_materi'));
                $newKontenMateri->deskripsi = $request->get('deskripsi');
                $newKontenMateri->konten = $request->get('konten');
                $newKontenMateri->urutan = $request->get('urutan_konten_materi');
                $newKontenMateri->save();
            } else {
                return redirect()->back()->withError('Urutan telah terdaftar.');
            }

            return redirect('master/konten-materi')->withStatus('Berhasil menambah data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            MateriKonten::destroy('id', $id);
            return redirect()->back()->withStatus('Berhasil menghapus data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
