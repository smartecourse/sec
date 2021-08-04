<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->middleware(['role:admin']);
    }
    
    public function index()
    {
        try {
            return view('admin.page.profile');
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $isEmailUnique = auth()->user()->email == $request->get('email') ? '' : '|unique:users,email';

            $request->validate([
                'nama_lengkap' => 'required',
                'email' => 'required|email|max:255|regex:/(.*)@myemail\.com/i'.$isEmailUnique,
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'min:8'
            ],
            [
                'required' => ':attribute harus diisi.',
                'password.min' => 'Minimal panjang karakter 8.',
                'password_confirmation.min' => 'Minimal panjang karakter 8.',
                'confirmed' => 'Password dan konfirmasi password tidak sesuai'
            ]);

            $updateProfile = User::find(auth()->user()->id);
            $updateProfile->nama = $request->get('nama_lengkap');
            $updateProfile->email = $request->get('email');
            $updateProfile->password = bcrypt($request->get('password'));
            $updateProfile->tentang_saya = $request->get('tentang_saya');
            $updateProfile->save();

            if($request->file('foto_profil') != null) {
                if(file_exists(auth()->user()->foto_profil)){
                    if(\File::delete(auth()->user()->foto_profil)){
                        $random = \Str::random(5);
                        $folder = 'upload/fotoProfil';
                        $file = $request->file('foto_profil');
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
                            $upFile = User::find(auth()->user()->id);
                            $upFile->foto_profil = $folder.'/'.$filename;
                            $upFile->save();
                        }
                    }
                }
                else {
                    $random = \Str::random(5);
                    $folder = 'upload/fotoProfil';
                    $file = $request->file('foto_profil');
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
                        $upFile = User::find(auth()->user()->id);
                        $upFile->foto_profil = $folder.'/'.$filename;
                        $upFile->save();
                    }
                }
            }
            
            return redirect()->back()->withStatus('Berhasil menyimpan perubahan.');
        }
        catch(\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }
}
