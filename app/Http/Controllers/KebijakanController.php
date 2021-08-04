<?php

namespace App\Http\Controllers;

use App\Models\KebijakanPrivasi;
use Illuminate\Http\Request;

class KebijakanController extends Controller
{
    private $param;

    public function index()
    {
        $this->param['data'] = KebijakanPrivasi::first();

        return view('admin.page.kebijakan-privasi.kebijakan-privasi', $this->param);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'kebijakan' => 'required'
        ],
        [
            'required' => ':attribute tidak boleh kosong.'
        ],
        [
            'kebijakan' => 'Kebijakan Privasi'
        ]);

        try {
            $kebijakan = KebijakanPrivasi::first();

            $kebijakan->konten = $request->get('kebijakan');
            $kebijakan->save();

            return redirect('master/kebijakan-privasi')->withStatus('Berhasil menyimpan data');
        }
        catch(\Exception $e){
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
