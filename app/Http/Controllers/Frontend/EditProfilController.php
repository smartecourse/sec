<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class EditProfilController extends Controller
{
    public $param;
    public function index()
    {
        $this->param['profil'] = User::find(Session::get('id_user'));
        return view('frontend.dashboard.edit-profil', $this->param);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ],
        [
            'required' => ':attribute tidak boleh kosong.'
        ],
        [
            'name' => 'Nama lengkap',
            'email' => 'Email',
        ]);

        try {
            $editprofil = User::find($id);
            $editprofil->nama=$request->get('name');
            $editprofil->phone=$request->get('no_hp');
            $editprofil->email=$request->get('email');
            $editprofil->tentang_saya = $request->get('bio');

            if($request->file('foto') != null) {
                if(file_exists(Session::get('foto_profil'))){
                    if(\File::delete(Session::get('foto_profil'))){
                        $random = \Str::random(5);
                        $folder = 'upload/fotoProfil';
                        $file = $request->file('foto');
                        $filename = date('H-i-s').$random.$file->getClientOriginalName();
                        // Get canonicalized absolute pathname
                        $path = realpath($folder);

                        // If it exist, check if it's a directory
                        if(!($path !== true AND is_dir($path)))
                        {
                            // Path/folder does not exist then create a new folder
                            mkdir($folder, 0755, true);
                        }
                        if($file->move($folder, $filename)) {
                            $editprofil->foto_profil = $folder.'/'.$filename;
                        }
                    }
                }
                else {
                    $random = \Str::random(5);
                    $folder = 'upload/fotoProfil';
                    $file = $request->file('foto');
                    $filename = date('H-i-s').$random.$file->getClientOriginalName();
                    // Get canonicalized absolute pathname
                    $path = realpath($folder);

                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($file->move($folder, $filename)) {
                        $editprofil->foto_profil = $folder.'/'.$filename;
                    }
                }
            }

            $editprofil->save();
            Session::put('nama', $editprofil->nama);
            Session::put('foto_profil', $editprofil->foto_profil);
            Session::put('profil_saya',$editprofil->tentang_saya);

            return back()->withStatus('Data berhasil di Edit');
        }
        catch(\Exception $e) {
            return back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return back()->withError($e->getMessage());
        }

    }

    public function edit($id)
    {
        $this->param['profil'] = User::where('id', $id)->first();

	    return view('frontend.dashboard.edit-profil', $this->param);
    }
}

