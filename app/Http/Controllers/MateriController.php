<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\MateriKonten;
use App\Models\Kelas;
use App\Models\JenisKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'materi';
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['listMateri'] = Materi::select('materi.*', 'kelas.judul_kelas', 'kelas.tipe_kelas')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->orderBy('kelas_id', 'ASC')
                                            ->get();
        return view('admin.page.materi.materi', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['listKelas'] = Kelas::select('kelas.*', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('paket', 'paket.id', 'kelas.paket_id')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->orderBy('kode_kelas', 'ASC')
                                        ->get();

        return view('admin.page.materi.materi-tambah', $this->param);
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
                'kelas' => 'not_in:0',
                'nama_materi' => 'required|min:3|max:50',
                'urutan' => 'required|numeric',
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
                'kelas' => 'Kelas',
                'nama_materi' => 'Nama Materi',
                'urutan' => 'Urutan',
            ]
        );
        try {
            $length = count($request->get('urutan_konten_materi'));
            $cekUrutan = Materi::where('kelas_id', $request->get('kelas'))->where('urutan', $request->get('urutan'))->first();
            if ($cekUrutan == NULL) {
                $newMateri = new Materi();
                $newMateri->kelas_id = $request->get('kelas');
                $newMateri->nama_materi = $request->get('nama_materi');
                $newMateri->slug = Str::slug($request->get('nama_materi'));
                $newMateri->urutan = $request->get('urutan');
                $newMateri->is_active = 'active';
                $newMateri->save();

                for ($i=0; $i < $length ; $i++) { 
                    $newKontenMateri = new MateriKonten();
                    $newKontenMateri->materi_id = $newMateri->id;
                    $newKontenMateri->judul_konten_materi = $request->get('judul_konten_materi')[$i];
                    $newKontenMateri->slug = Str::slug($request->get('judul_konten_materi')[$i]);
                    $newKontenMateri->deskripsi = $request->get('deskripsi')[$i];
                    $newKontenMateri->konten = $request->get('konten')[$i];
                    $newKontenMateri->urutan = $request->get('urutan_konten_materi')[$i];
                    $newKontenMateri->save();
                };
                
                return redirect('master/materi')->withStatus('Berhasil menambah data.');
            } else {
                return redirect()->back()->withError('Urutan telah terdaftar.');
            }
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
        try {
            $this->param['getMateriDetail'] = Materi::select('materi.*', 'kelas.judul_kelas', 'kelas.tipe_kelas')->join('kelas', 'materi.kelas_id', 'kelas.id')->where('materi.id', $id)->first();
            $this->param['getKontenMateri'] = MateriKonten::where('materi_id', $id)->orderBy('urutan', 'ASC')->get();

            return view('admin.page.materi.materi-detail', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $this->param['getMateri'] = Materi::findOrFail($id);
            $this->param['listKelas'] = Kelas::select('kelas.*', 'kelas_jenis.nama_jenis_kelas')
                                            ->join('paket', 'paket.id', 'kelas.paket_id')
                                            ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                            ->orderBy('kode_kelas', 'ASC')
                                            ->get();

            return view('admin.page.materi.materi-edit', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
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
                'kelas' => 'not_in:0',
                'nama_materi' => 'required|min:3|max:50',
                'urutan' => 'required|numeric',
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
                'kelas' => 'Kelas',
                'nama_materi' => 'Nama Materi',
                'urutan' => 'Urutan',
            ]
        );
        try {
            $cekUrutan = Materi::where('kelas_id', $request->get('kelas'))->where('urutan', $request->get('urutan'))->where('id', '!=', $id)->first();
            if ($cekUrutan == NULL) {
                $newMateri = Materi::find($id);
                $newMateri->kelas_id = $request->get('kelas');
                $newMateri->nama_materi = $request->get('nama_materi');
                $newMateri->slug = Str::slug($request->get('nama_materi'));
                $newMateri->urutan = $request->get('urutan');
                $newMateri->is_active = 'active';
                $newMateri->save();
                
                return redirect('master/materi')->withStatus('Berhasil memperbarui data.');
            } else {
                return redirect()->back()->withError('Urutan telah terdaftar.');
            }
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
            Materi::find($id)->delete();
            
            return redirect('master/materi')->withStatus('Berhasil menghapus materi.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function disable($id)
    {
        try {
            Materi::where('id', $id)->update([
                'is_active' => 'deactive'
            ]);
            return redirect('master/materi')->withStatus('Berhasil menonaktifkan data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
