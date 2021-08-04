<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kelas;
use App\Models\Paket;
use Illuminate\Http\Request;

class FasilitasKelasController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->param['listFasilitas'] = Fasilitas::select('fasilitas_kelas.*', 'paket.nama_paket', 'kelas_jenis.nama_jenis_kelas')
                                                ->join('paket', 'paket.id', 'fasilitas_kelas.id_paket')
                                                ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                                ->get();

        $this->param['listPaket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->orderBy('nama_paket', 'ASC')
                                        ->get();

        return view('admin.page.fasilitas-kelas.kelas-fasilitas', $this->param);
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
                'fasilitas' => 'required|min:3|max:50',
                'paket' => 'required|not_in:0',
            ],
            [
                'required' => ':attribute harus diisi.',
                'fasilitas.min' => 'Minimal panjang karakter 3.',
                'fasilitas.max' => 'Maksimal panjang karakter 50.',
                'not_in' => ':attribute belum dipilih.'
            ],
            [
                'fasilitas' => 'Fasilitas paket',
                'paket' => 'Paket'
            ]
        );
        try {
            $checkFasilitasExists = Fasilitas::where('id_paket', $request->get('paket'))->where('fasilitas', $request->get('fasilitas'))->count();
            if($checkFasilitasExists > 0) {
                return redirect()->back()->withError('Fasilitas telah digunakan.');
            }
            else {
                $newFasilitas = new Fasilitas();
                $newFasilitas->fasilitas = $request->get('fasilitas');
                $newFasilitas->id_paket = $request->get('paket');
                $newFasilitas->save();
    
                return redirect('master/fasilitas-paket')->withStatus('Berhasil menambah data.');
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
            $this->param['fasilitasPaket'] = Fasilitas::findOrFail($id);
            $this->param['listPaket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                            ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                            ->orderBy('nama_paket', 'ASC')
                                            ->get();

            return view('admin.page.fasilitas-kelas.kelas-fasilitas-edit', $this->param);
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
        $updateFasilitas = Fasilitas::findOrFail($id);
        $isFasilitasUnique = $updateFasilitas->fasilitas == $request->get('fasilitas') ? '' : '|unique:fasilitas_kelas,fasilitas';

        try {
            $this->validate($request, 
                [
                    'fasilitas' => 'required|min:3|max:50'.$isFasilitasUnique,
                    'paket' => 'required|not_in:0',
                ],
                [
                    'required' => ':attribute harus diisi.',
                    'fasilitas.min' => 'Minimal panjang karakter 3.',
                    'fasilitas.max' => 'Maksimal panjang karakter 50.',
                    'unique' => ':attribute telah terdaftar.',
                    'not_in' => ':attribute belum dipilih.'
                ],
                [
                    'fasilitas' => 'Fasilitas',
                    'paket' => 'Paket'
                ]
            );

            $updateFasilitas->fasilitas = $request->get('fasilitas');
            $updateFasilitas->id_paket = $request->get('paket');
            $updateFasilitas->save();

            return redirect('master/fasilitas-paket')->withStatus('Berhasil menyimpan data.');
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
            Fasilitas::destroy('id', $id);
            return redirect('master/fasilitas-paket')->withStatus('Berhasil menghapus data.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
