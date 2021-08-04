<?php

namespace App\Http\Controllers;
use Str;

use Illuminate\Http\Request;
use App\Models\User;

class AkunController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->param['onSide'] = 'akun';
        $this->middleware(['role:admin']);
    }

    public function index()
    {
        $this->param['listDataUser'] = User::role('users')->where('is_active', 'active')->get();
        $this->param['listDataAdmin'] = User::role('admin')->where('is_active', 'active')->get();
        return view('admin.page.akun.akun', $this->param);
    }

    public function add()
    {
        return view('admin.page.akun.akun-tambah', $this->param);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|min:6|unique:users',
            'password' => 'Required_with:password_konfirmasi|same:password_konfirmasi|min:8',
            'password_konfirmasi' => 'min:8',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'status_member' => 'required',
            'roled' => 'required'
        ]);

        $date = date('H-i-s');
        $random = \Str::random(5);

        try {
            $newUser = new User();
            $newUser->nama = $request->nama_lengkap;
            $newUser->email = $request->email;
            $newUser->password = bcrypt($request->password);
            $newUser->tentang_saya = $request->tentang_saya;

            if ($request->file('foto_profil')) {
                $request->file('foto_profil')->move('upload/fotoProfil', $date.$random.$request->file('foto_profil')->getClientOriginalName());
                $newUser->foto_profil = $date.$random.$request->file('foto_profil')->getClientOriginalName();
            }

            $newUser->status_member = $request->status_member;
            // $newUser->email_verified_at = now();
            $newUser->is_active = 'active';
            $newUser->remember_token = Str::random(60);
            $newUser->save();

            if ($request->roled == 'admin') {
                $newUser->assignRole('admin');
            } else {
                $newUser->assignRole('users');
            }

            /* $this->param['success'] = 'Berhasil Menambahkan Akun'; */
            return redirect('/master/akun')->withStatus('Berhasil Menambahkan Akun Baru');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Terjadi Kesalahan '.$th);
        }
    }

    public function detail(User $user)
    {
        $this->param['getUserDetail'] = $user;
        return view('admin.page.akun.akun-detail', $this->param);
    }

    public function resetPassword(User $user)
    {
    
        try {
            User::where('id', $user->id)->update([
                'password' => bcrypt('@Sec-2021')
            ]);
            return redirect('/master/akun')->withStatus('Berhasil Reset Password');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Terjadi Kesalahan '.$th);
        }

    }

    public function deactiveAccount(User $user)
    {
        try {
            User::where('id', $user->id)->update([
                'is_active' => 'deactive'
            ]);
            return redirect('/master/akun')->withStatus('Berhasil Menghapus Akun');
        } catch (\Throwable $th) {
            return redirect()->back()->withError('Terjadi Kesalahan '.$th);
        }

    }
}
