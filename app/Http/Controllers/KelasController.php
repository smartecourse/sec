<?php

namespace App\Http\Controllers;

use App\Models\JenisKelas;
use App\Models\Kelas;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class KelasController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'kelas';
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['listKelas'] = Kelas::select('kelas.*', 'paket.nama_paket', 'paket.kelas_jenis_id', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('paket', 'paket.id', 'kelas.paket_id')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->orderBy('kode_kelas', 'ASC')->get();

        return view('admin.page.kelas.kelas', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodeKelas = null;
        $kelas = Kelas::orderBy('kode_kelas', 'DESC')->get();
        $this->param['paketKelas'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                        ->orderBy('nama_paket', 'ASC')
                                        ->get();

        if($kelas->count() > 0){
            $kodeKelas = $kelas[0]->kode_kelas;

            $lastIncrement = substr($kodeKelas, 2);

            $kodeKelas = str_pad($lastIncrement + 1, 5, 0, STR_PAD_LEFT);
            $kodeKelas = 'KK'.$kodeKelas;

        }
        else{
            $kodeKelas = "KK00001";
        }
        $this->param['kodeKelas'] = $kodeKelas;

        return view('admin.page.kelas.kelas-tambah', $this->param);
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
                'kode_kelas' => 'required|unique:kelas,kode_kelas',
                'paket_kelas' => 'required|not_in:0',
                'deskripsi' => 'required|min:20',
                'cover' => 'required',
                'author' => 'required',
                'tipe_kelas' => 'not_in:0',
            ],
            [
                'required' => ':attribute harus diisi.',
                'deskripsi.min' => 'Minimal panjang karakter 20.',
                'unique' => ':attribute telah terdaftar.',
                'not_in' => ':attribute harus dipilih.'
            ],
            [
                'kode_kelas' => 'Kode kelas',
                'paket_kelas' => 'Paket kelas',
                'deskripsi' => 'Deskripsi',
                'cover' => 'Sampul',
                'author' => 'Author',
                'tipe_kelas' => 'Tipe kelas',
            ]
        );

        try{
            $paket = Paket::find($request->get('paket_kelas'));

            $newKelas = new Kelas;
            $newKelas->paket_id = $paket->id;
            $newKelas->kode_kelas = $request->get('kode_kelas');
            $newKelas->judul_kelas = $paket->nama_paket;
            $newKelas->slug = Str::slug($paket->nama_paket).'-'.$request->get('tipe_kelas');
            $newKelas->deskripsi = $request->get('deskripsi');
            $newKelas->intro = $request->get('intro');
            $newKelas->intro_link = $request->get('intro_video');
            $newKelas->by_author = $request->get('author');
            $newKelas->tipe_kelas = $request->get('tipe_kelas');
            $newKelas->save();

            if($request->file('cover') != null) {
                $folder = 'upload/kelas/'.$request->get('kode_kelas');
                $file = $request->file('cover');
                $filename = date('YmdHis').$file->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }
                if($file->move($folder, $filename)) {
                    $upFile = Kelas::find($newKelas->id);
                    $upFile->cover = $folder.'/'.$filename;
                    $upFile->save();
                }
            }

            if($request->file('pdf_file') != null) {
                $folder = 'upload/kelas/'.$request->get('kode_kelas');
                $file = $request->file('pdf_file');
                $filename = date('YmdHis').$file->getClientOriginalName();
                // Get canonicalized absolute pathname
                $path = realpath($folder);

                // If it exist, check if it's a directory
                if(!($path !== true AND is_dir($path)))
                {
                    // Path/folder does not exist then create a new folder
                    mkdir($folder, 0755, true);
                }
                if($file->move($folder, $filename)) {
                    $upFile = Kelas::find($newKelas->id);
                    $upFile->pdf_file = $folder.'/'.$filename;
                    $upFile->save();
                }
            }

            return redirect('master/kelas')->withStatus('Berhasil menambah data.');
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
            $this->param['kelas'] = Kelas::select('kelas.*', 'kelas_jenis.id AS kelas_jenis_id', 'kelas_jenis.nama_jenis_kelas', 'paket.nama_paket', 'paket.diskon')
                                        ->join('paket', 'paket.id', 'kelas.paket_id')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->where('kelas.id', $id)
                                        ->first();  

            return view('admin.page.kelas.kelas-detail', $this->param);
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
            // $this->param['kelas'] = Kelas::select('kelas.*','kelas_jenis.nama_jenis_kelas', 'paket.nama_paket')
            //                             ->join('paket', 'paket.id', 'kelas.paket_id')
            //                             ->join('kelas_jenis', 'kelas_jenis.id', 'kelas.kelas_jenis_id')
            //                             ->where('kelas.id', $id)
            //                             ->first();
            // $this->param['paketKelas'] = Paket::orderBy('nama_paket', 'ASC')->get();
            $this->param['kelas'] = Kelas::select('kelas.*', 'kelas_jenis.id AS kelas_jenis_id', 'kelas_jenis.nama_jenis_kelas', 'paket.nama_paket')
                                        ->join('paket', 'paket.id', 'kelas.paket_id')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->where('kelas.id', $id)
                                        ->first();
            $this->param['paketKelas'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('kelas_jenis', 'paket.kelas_jenis_id', 'kelas_jenis.id')
                                        ->orderBy('nama_paket', 'ASC')
                                        ->get();

            return view('admin.page.kelas.kelas-edit', $this->param);
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
        try{
            $updateKelas = Kelas::find($id);
            $isKelasUnique = $updateKelas->judul_kelas == $request->get('nama_kelas') ? '' : '|unique:kelas,judul_kelas';

            // return $request;
            $this->validate($request,
                [
                    'paket_kelas' => 'required|not_in:0',
                    'deskripsi' => 'required|min:20',
                    'intro_video' => 'required',
                    'author' => 'required',
                    'tipe_kelas' => 'not_in:0',
                    'status_kelas' => 'not_in:0',
                ],
                [
                    'required' => ':attribute harus diisi.',
                    'deskripsi.min' => 'Minimal panjang karakter 20.',
                    'unique' => ':attribute telah terdaftar.',
                    'not_in' => ':attribute harus dipilih.'
                ],
                [
                    'paket_kelas' => 'Paket kelas',
                    'deskripsi' => 'Deskripsi',
                    'intro_video' => 'Intro video',
                    'author' => 'Author',
                    'tipe_kelas' => 'Tipe kelas',
                    'status_kelas' => 'Status kelas',
                ]
            );

            $paket = Paket::find($request->get('paket_kelas'));

            $updateKelas->paket_id = $paket->id;
            $updateKelas->kode_kelas = $request->get('kode_kelas');
            $updateKelas->judul_kelas = $paket->nama_paket;
            $updateKelas->slug = Str::slug($paket->nama_paket).'-'.$request->get('tipe_kelas');
            $updateKelas->deskripsi = $request->get('deskripsi');
            $updateKelas->intro = $request->get('intro');
            $updateKelas->intro_link = $request->get('intro_video');
            $updateKelas->by_author = $request->get('author');
            $updateKelas->tipe_kelas = $request->get('tipe_kelas');
            $updateKelas->is_active = $request->get('status_kelas');
            $updateKelas->save();

            if($request->file('cover') != null) {
                if(file_exists($updateKelas->cover)){
                    if(File::delete($updateKelas->cover)){
                        /* jika berhasil menghapus cover file */
                        $folder = 'upload/kelas/'.$updateKelas->kode_kelas;
                        $file = $request->file('cover');
                        $filename = date('YmdHis').$file->getClientOriginalName();
                        // Get canonicalized absolute pathname
                        $path = realpath($folder);

                        // If it exist, check if it's a directory
                        if(!($path !== true AND is_dir($path)))
                        {
                            // Path/folder does not exist then create a new folder
                            mkdir($folder, 0755, true);
                        }
                        if($file->move($folder, $filename)) {
                            $upFile = Kelas::find($updateKelas->id);
                            $upFile->cover = $folder.'/'.$filename;
                            $upFile->save();
                        }
                    }
                }
            }

            if($request->file('pdf_file') != null) {
                if(file_exists($updateKelas->pdf_file)){
                    if(File::delete($updateKelas->pdf_file)){
                        /* jika berhasil menghapus pdf file */
                        $folder = 'upload/kelas/'.$updateKelas->kode_kelas;
                        $file = $request->file('pdf_file');
                        $filename = date('YmdHis').$file->getClientOriginalName();
                        // Get canonicalized absolute pathname
                        $path = realpath($folder);

                        // If it exist, check if it's a directory
                        if(!($path !== true AND is_dir($path)))
                        {
                            // Path/folder does not exist then create a new folder
                            mkdir($folder, 0755, true);
                        }
                        if($file->move($folder, $filename)) {
                            $upFile = Kelas::find($updateKelas->id);
                            $upFile->pdf_file = $folder.'/'.$filename;
                            $upFile->save();
                        }
                    }
                }
                else {
                    $folder = 'upload/kelas/'.$updateKelas->kode_kelas;
                    $file = $request->file('pdf_file');
                    $filename = date('YmdHis').$file->getClientOriginalName();
                    // Get canonicalized absolute pathname
                    $path = realpath($folder);

                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($file->move($folder, $filename)) {
                        $upFile = Kelas::find($updateKelas->id);
                        $upFile->pdf_file = $folder.'/'.$filename;
                        $upFile->save();
                    }
                }
            }

            return redirect('master/kelas')->withStatus('Berhasil menyimpan data.');
        }
        catch(\Exception $e){
            return $e;
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
        // upload/kelas/KK00002/20210622160201oseng.jpg
        // upload/kelas/KK00002
        try {
            $kelas = Kelas::findOrFail($id);

            $folder = explode('/', $kelas->cover);
            $folder = $folder[0].'/'.$folder[1].'/'.$folder[2].'/';

            if(File::deleteDirectory(public_path($folder))) {
                $kelas->delete();
            }


            // if($kelas->tipe_kelas == 'video') {
            //     /* jike tipe kelas adalah video */
            //     File::deleteDirectory(public_path('path/to/folder'));
            //     if($cover != null){
            //         if(file_exists($cover)){
            //             if(File::delete($cover)){
            //                 /* jika berhasil menghapus file cover */
            //                 $kelas->delete();
            //             }
            //         }
            //     }
            // }
            // else {
            //     /* jika tipe kelas adalah ebook */
            //     if($cover != null && $pdf != null){
            //         if(file_exists($cover) && file_exists($pdf)){
            //             if(File::delete($cover) && File::delete($pdf)){
            //                 /* jika berhasil menghapus kedua file */
            //                 $kelas->delete();
            //             }
            //         }
            //     }
            // }

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
