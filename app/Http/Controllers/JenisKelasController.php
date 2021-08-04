<?php

namespace App\Http\Controllers;

use App\Models\JenisKelas;

use Illuminate\Http\Request;

class JenisKelasController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'kelas-jenis';
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['listJenisKelas'] = JenisKelas::all();
        // return $this->param['listJenisKelas'];
        return view('admin.page.kelas-jenis.kelas-jenis', $this->param);
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
                'nama_jenis_kelas' => 'required|min:3|max:50|unique:kelas_jenis,nama_jenis_kelas',
                'deskripsi' => 'required|min:20',
                'bobot' => 'required'
            ],
            [
                'required' => ':attribute harus diisi.',
                'nama_jenis_kelas.min' => 'Minimal panjang karakter 3.',
                'nama_jenis_kelas.max' => 'Maksimal panjang karakter 50.',
                'deskripsi.min' => 'Minimal panjang karakter 20.',
                'unique' => ':attribute telah terdaftar.'
            ],
            [
                'nama_jenis_kelas' => 'Nama Jenis Kelas',
                'deskripsi' => 'Deskripsi',
                'bobot' => 'Bobot'
            ]
        );
        try {
            $newJenisKelas = new JenisKelas();
            $newJenisKelas->nama_jenis_kelas = $request->get('nama_jenis_kelas');
            $newJenisKelas->deskripsi = $request->get('deskripsi');
            $newJenisKelas->bobot = $request->get('bobot');
            $newJenisKelas->save();

            return redirect('master/jenis-kelas')->withStatus('Berhasil menambah data.');
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
        try {
            $this->param['jenisKelas'] = JenisKelas::findOrFail($id);

            return view('admin.page.kelas-jenis.kelas-jenis-edit', $this->param);
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
        $updateJenis = JenisKelas::findOrFail($id);
        $isJenisUnique = $updateJenis->nama_jenis_kelas == $request->get('nama_jenis_kelas') ? '' : '|unique:kelas_jenis,nama_jenis_kelas';

        try {
            $this->validate($request, 
                [
                    'nama_jenis_kelas' => 'required|min:3|max:50'.$isJenisUnique,
                    'deskripsi' => 'required|min:20',
                    'bobot' => 'required'
                ],
                [
                    'required' => ':attribute harus diisi.',
                    'nama_jenis_kelas.min' => 'Minimal panjang karakter 3.',
                    'nama_jenis_kelas.max' => 'Maksimal panjang karakter 50.',
                    'deskripsi.min' => 'Minimal panjang karakter 20.',
                    'unique' => ':attribute telah terdaftar.'
                ],
                [
                    'nama_jenis_kelas' => 'Nama Jenis Kelas',
                    'deskripsi' => 'Deskripsi',
                    'bobot' => 'Bobot',
                ]
            );

            $updateJenis->nama_jenis_kelas = $request->get('nama_jenis_kelas');
            $updateJenis->deskripsi = $request->get('deskripsi');
            $updateJenis->bobot = $request->get('bobot');
            $updateJenis->save();

            return redirect('master/jenis-kelas')->withStatus('Berhasil menyimpan data.');
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
            JenisKelas::destroy('id', $id);
            return redirect('master/jenis-kelas')->withStatus('Berhasil menghapus data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
