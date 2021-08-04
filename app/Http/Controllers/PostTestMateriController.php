<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\MateriPostTest;
use DB;
use Str;

class PostTestMateriController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'post-test-materi';
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $this->param['listPostTest'] = MateriPostTest::select('materi_post_test.*', 'materi.nama_materi', 'kelas.judul_kelas')
                                            ->join('materi', 'materi_post_test.materi_id', 'materi.id')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->get();
            return view('admin.page.materi-post-test.post-test-materi', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $this->param['listMateri'] = Materi::select('materi.*', 'kelas.judul_kelas', 'kelas.tipe_kelas')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->orderBy('kelas_id', 'ASC')
                                            ->get();
            return view('admin.page.materi-post-test.post-test-materi-tambah', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
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
                'judul_post_test' => 'required|min:3|max:50|unique:materi_post_test,judul_post_test',
                'embed_link' => 'required',
            ],
            [
                'required' => ':attribute harus diisi.',
                'judul_post_test.min' => 'Minimal panjang karakter 3.',
                'deskripsi.min' => 'Minimal panjang karakter 20.',
                'max' => 'Maksimal panjang karakter 50.',
                'unique' => ':attribute telah terdaftar.',
                'not_in' => ':attribute harus dipilih.',
                'numeric' => 'Karakter yang dimasukkan harus berupa angka.'
            ],
            [
                'materi' => 'Materi',
                'judul_post_test' => 'Judul Post Test',
                'embed_link' => 'Embed Link',
            ]
        );

        try {
            $newPostTest = new MateriPostTest();
            $newPostTest->materi_id = $request->get('materi');
            $newPostTest->judul_post_test = $request->get('judul_post_test');
            $newPostTest->slug = Str::slug($request->get('judul_post_test'));
            $newPostTest->embed_link = $request->get('embed_link');
            $newPostTest->is_active = 'active';
            $newPostTest->save();

            return redirect('master/post-test-materi')->withStatus('Berhasil menambah data.');
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
            $this->param['getDataPostTest'] = MateriPostTest::select('materi_post_test.*', 'materi.nama_materi', 'kelas.judul_kelas')
            ->join('materi', 'materi_post_test.materi_id', 'materi.id')
            ->join('kelas', 'materi.kelas_id', 'kelas_id')
            ->findOrFail($id);

            return view('admin.page.materi-post-test.post-test-materi-detail', $this->param);
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
            $this->param['getDataPostTest'] = MateriPostTest::findOrFail($id);
            $this->param['listMateri'] = Materi::select('materi.*', 'kelas.judul_kelas', 'kelas.tipe_kelas')
                                            ->join('kelas', 'materi.kelas_id', 'kelas.id')
                                            ->orderBy('kelas_id', 'ASC')
                                            ->get();

            return view('admin.page.materi-post-test.post-test-materi-edit', $this->param);
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
        $getValidate = MateriPostTest::find($id);
        if($getValidate->judul_post_test != $request->get('judul_post_test'))
        {
            $this->validate($request, 
                [
                    'materi' => 'not_in:0',
                    'judul_post_test' => 'required|min:3|max:50|unique:materi_post_test,judul_post_test',
                    'embed_link' => 'required',
                ],
                [
                    'required' => ':attribute harus diisi.',
                    'judul_post_test.min' => 'Minimal panjang karakter 3.',
                    'deskripsi.min' => 'Minimal panjang karakter 20.',
                    'max' => 'Maksimal panjang karakter 50.',
                    'unique' => ':attribute telah terdaftar.',
                    'not_in' => ':attribute harus dipilih.',
                    'numeric' => 'Karakter yang dimasukkan harus berupa angka.'
                ],
                [
                    'materi' => 'Materi',
                    'judul_post_test' => 'Judul Post Test',
                    'embed_link' => 'Embed Link',
                ]
            );
        }
        
        try {

            $newPostTest = MateriPostTest::find($id);
            $newPostTest->materi_id = $request->get('materi');
            $newPostTest->judul_post_test = $request->get('judul_post_test');
            $newPostTest->slug = Str::slug($request->get('judul_post_test'));
            $newPostTest->embed_link = $request->get('embed_link');
            $newPostTest->save();

            return redirect('master/post-test-materi')->withStatus('Berhasil memperbarui data.');
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
            MateriPostTest::find($id)->delete();
            return redirect('master/post-test-materi')->withStatus('Berhasil menghapus post test.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
