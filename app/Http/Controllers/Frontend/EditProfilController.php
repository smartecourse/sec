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
            'no_hp' => 'required'
        ],
        [
            'required' => ':attribute tidak boleh kosong.'
        ],
        [
            'name' => 'Nama lengkap',
            'email' => 'Email',
            'no_hp' => 'Nomor Handphone'
        ]);
        // $data = "Data";
        // if ($request->password == null) {
        //   return $data;
        // }else{
        //     echo "data adata";
        // }
        $editprofil = User::find($id);
        $editprofil->nama=$request->get('name');
        $editprofil->phone=$request->get('no_hp');
        $editprofil->email=$request->get('email');

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

        return redirect('/dashboard')->with('success','Data berhasil di Edit');
    }

    public function edit($id)
    {
        $this->param['profil'] = User::where('id', $id)->first();

	    return view('frontend.dashboard.edit-profil', $this->param);
    }
}

