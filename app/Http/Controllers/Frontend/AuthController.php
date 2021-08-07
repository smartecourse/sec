<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        if(Session::has('token')) {
            // sudah login
            return back();
        }
        return view('frontend.auth.login');
    }

    public function loginProcess(Request $request)
    {
        try {
            // if(Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            //     // $token = auth()->user()->createToken('token')->plainTextToken;
            //     // return $token;
            //     // return view('frontend.home')->with('nama', $user->nama);
            //     // Session::put('token', $token);
            //     // Session::put('nama', $user->nama);
            //     // return view('frontend.landing-page');
            //     return redirect('/');
            //     // return auth()->user();
            // }
            // else {
            //     return redirect()->back()->withError('akun tidak ditemukan');
            // }
            $user = User::role('users')->where('email', $request->get('email'))->first();
            if($user == null) {
                return redirect()->back()->withError('akun tidak ditemukan');
            }
            else {
                if ($user->hasVerifiedEmail()) {
                    if ($user->is_active == 'active') {
                        if (!$user || !(\Hash::check($request->get('password'), $user->password))) {

                            return redirect()->back()->withError('password salah');
                        }
                        else{
                            $token = $user->createToken('token')->plainTextToken;
                            // return $token;
                            // return view('frontend.home')->with('nama', $user->nama);
                            Session::put('token', $token);
                            Session::put('id_user', $user->id);
                            Session::put('nama', $user->nama);
                            Session::put('is_google', $user->is_google);
                            Session::put('is_active', $user->is_active);
                            Session::put('foto_profil', $user->foto_profil);
                            Session::put('status_member', $user->status_member);
                            Session::put('profil_saya',$user->tentang_saya);
                            // return view('frontend.landing-page');
                            return redirect('/');
                        }   
                    }else{
                        return redirect()->back()->withError('akun anda belum aktif');
                    }
                }else{
                    return redirect()->back()->withError('harap verifikasi email terlebih dahulu!');
                }

                
            }


        } catch(\Exception $e){
            return redirect()->back()->withError('exception error : '.$e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('query exception error : '.$e->getMessage());
        }
    }

    public function register()
    {
        return view('frontend.auth.registrasi');
    }

    public function registerProcess(Request $request)
    {
        $this->validate($request,
            [
                'nama' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'string|min:8|required_with:konfirmasiPassword|same:konfirmasiPassword',
                'konfirmasiPassword' => 'min:8',
                'check' => 'required'
            ],
            [
                'required' => ':attribute harus diisi.',
                'min' => 'Minimal panjang karakter 8.',
                'max' => 'Maksimal panjang karakter 50.',
                'same' => ':attribute harus sama',
                'check.required' => ':attribute harus di centang'
            ],
            [
                'nama' => 'Nama Lengkap',
                'email' => 'Email',
                'password' => 'Password',
                'konfirmasiPassword' => 'Konfirmasi Password',
                'check' => 'Kebijakan Privasi'
            ]
        );
        try {
            /* $newUser = new User();
            $newUser->nama = $request->get('nama');
            $newUser->email = $request->get('email');
            $newUser->password = bcrypt($request->get('password'));
            $newUser->foto_profil = 'default.png';
            $newUser->status_member = 'reguler';
            $newUser->is_active = 'active'; */
            /* $newUser->save(); */
            $newUser = User::create([
                'nama' => $request->get('nama'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'foto_profil' => 'default.png',
                'status_member' => 'reguler',
                'is_active' => 'deactive',
                'remember_token' => Str::random(60),
            ]);
            $newUser->assignRole('users');

            event(new Registered($newUser));

            return redirect()->back()->withSuccess('Mendaftar');
        } catch(\Exception $e){
            return redirect()->back()->withError('exception error : '.$e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('query exception error : '.$e->getMessage());
        }
        /* return view('frontend.auth.registrasi'); */
    }
}
