<?php

namespace App\Http\Controllers;

use App\Models\JenisKelas;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;

class PaketController extends Controller
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
        $this->param['listPaket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
        $this->param['jenisKelas'] = JenisKelas::orderBy('nama_jenis_kelas', 'ASC')->get();

        return view('admin.page.paket.paket', $this->param);
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
                'nama_paket' => 'required|min:3|max:50|unique:paket,nama_paket',
                'harga' => 'required',
                'deadline' => 'required',
                'jenis_kelas' => 'required|not_in:0',
                'cover' => 'required'
            ],
            [
                'required' => ':attribute harus diisi.',
                'nama_paket.min' => 'Minimal panjang karakter 3.',
                'nama_paket.max' => 'Maksimal panjang karakter 50.',
                'deskripsi.max' => 'Minimal panjang karakter 20.',
                'unique' => ':attribute telah terdaftar.',
                'not_in' => ':attribute harus dipilih.'
            ],
            [
                'nama_paket' => 'Nama Paket',
                'harga' => 'Harga',
                'deadline' => 'Masa Berlaku',
                'jenis_kelas' => 'Jenis Kelas',
                'cover' => 'Sampul'
            ]
        );
        try {
            $newPaket = new Paket();
            $newPaket->nama_paket = $request->get('nama_paket');
            $newPaket->slug = Str::slug($request->get('nama_paket'));
            $newPaket->kelas_jenis_id = $request->get('jenis_kelas');
            $newPaket->harga = $request->get('harga');
            $newPaket->diskon = $request->get('diskon') != null ? $request->get('diskon') : 0;
            $newPaket->deadline = $request->get('deadline');
            $newPaket->link_zoom = $request->get('link_zoom');
            $newPaket->group_whatsapp = $request->get('group_whatsapp');
            $newPaket->save();

            if($request->file('cover') != null) {
                $folder = 'upload/paket/'.$newPaket->nama_paket;
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
                    $upFile = Paket::find($newPaket->id);
                    $upFile->cover = $folder.'/'.$filename;
                    $upFile->save();
                }
            }

            return redirect('master/paket')->withStatus('Berhasil menambah data.');
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
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $this->param['getPaket'] = Paket::findOrFail($id);
            $this->param['jenisKelas'] = JenisKelas::orderBy('nama_jenis_kelas', 'ASC')->get();

            return view('admin.page.paket.paket-edit', $this->param);
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
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $updatePaket = Paket::findOrFail($id);
        $isPaketUnique = $updatePaket->nama_paket == $request->get('nama_paket') ? '' : '|unique:paket,nama_paket';

        try {
            $this->validate($request, 
                [
                    'nama_paket' => 'required|min:3|max:50'.$isPaketUnique,
                    'harga' => 'required',
                    'deadline' => 'required',
                    'jenis_kelas' => 'required|not_in:0'
                ],
                [
                    'required' => ':attribute harus diisi.',
                    'nama_paket.min' => 'Minimal panjang karakter 3.',
                    'nama_paket.max' => 'Maksimal panjang karakter 50.',
                    'deskripsi.max' => 'Minimal panjang karakter 20.',
                    'unique' => ':attribute telah terdaftar.',
                    'not_in' => ':attribute harus dipilih.'
                ],
                [
                    'nama_paket' => 'Nama Jenis Kelas',
                    'harga' => 'Harga',
                    'deadline' => 'Masa Berlaku',
                    'jenis_kelas' => 'Jenis Kelas'
                ]
            );
            $updatePaket->nama_paket = $request->get('nama_paket');
            $updatePaket->slug = Str::slug($request->get('nama_paket'));
            $updatePaket->kelas_jenis_id = $request->get('jenis_kelas');
            $updatePaket->harga = $request->get('harga');
            $updatePaket->diskon = $request->get('diskon') != null ? $request->get('diskon') : 0;
            $updatePaket->deadline = $request->get('deadline');
            $updatePaket->link_zoom = $request->get('link_zoom');
            $updatePaket->group_whatsapp = $request->get('group_whatsapp');
            $updatePaket->save();

            if($request->file('cover') != null) {
                if(file_exists($updatePaket->cover)){
                    if(File::delete($updatePaket->cover)){
                        /* jika berhasil menghapus cover file */
                        $folder = 'upload/paket/'.$updatePaket->nama_paket;
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
                            $upFile = Paket::find($updatePaket->id);
                            $upFile->cover = $folder.'/'.$filename;
                            $upFile->save();
                        }
                    }
                }
                else {
                    $folder = 'upload/paket/'.$updatePaket->nama_paket;
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
                        $upFile = Paket::find($updatePaket->id);
                        $upFile->cover = $folder.'/'.$filename;
                        $upFile->save();
                    }
                }
            }

            return redirect('master/paket')->withStatus('Berhasil memperbarui data.');
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
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $paket = Paket::findOrFail($id);
            if($paket->cover != null) {
                $folder = explode('/', $paket->cover);
                $folder = $folder[0].'/'.$folder[1].'/'.$folder[2].'/';
                
                if(File::deleteDirectory(public_path($folder))) {
                    $paket->delete();
                }
            }
            else {
                $paket->delete();
            }
            return redirect('master/paket')->withStatus('Berhasil menghapus data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
