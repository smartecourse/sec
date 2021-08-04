<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // return $user->email;
            // return dd($user);
            // $avatar = $user->avatar;
            $avatar = $user->avatar;
            $findUser = User::role('users')->where('email', $user->email)->first();

            if ($findUser) {
                $updateUser = User::find($findUser->id);
                $updateUser->nama = $user->name;
                $updateUser->email = $user->email;
                $updateUser->foto_profil = $user->avatar;
                $updateUser->save();
                Session::put('token', $user->token);
                Session::put('id_user', $findUser->id);
                Session::put('nama', $findUser->nama);
                Session::put('foto_profil', $findUser->foto_profil);
                Session::put('status', $findUser->status_member);
                Session::put('is_active', $findUser->is_active);
                Session::put('is_google',$findUser->is_google);
                Session::put('profil_saya',$findUser->tentang_saya);
                return redirect('/');
            }else{
                // $createUserGoogle = User::create([
                //     'nama' => $user->name,
                //     'email' => $user->email,
                //     'password' => Hash::make('secweb'),
                //     'foto_profil' => 'avatar',
                //     'status_member' =>'regular',
                //     'is_active' => 'active',
                //     'remember_token' => Str::random(60),

                // ]);
                $createUserGoogle = new User();
                $createUserGoogle->nama = $user->name;
                $createUserGoogle->email = $user->email;
                $createUserGoogle->password = Hash::make('secweb');
                $createUserGoogle->foto_profil = $avatar;
                $createUserGoogle->status_member = 'reguler';
                $createUserGoogle->is_active = 'active';
                $createUserGoogle->remember_token = Str::random(60);
                $createUserGoogle->is_google = 1;
                $createUserGoogle->assignRole('users');
                $createUserGoogle->save();

                if ($createUserGoogle) {
                    $token = $createUserGoogle->createToken('token')->plainTextToken;
                    Session::put('token',$token);
                    Session::put('id_user', $createUserGoogle->id);
                    Session::put('nama', $createUserGoogle->nama);
                    Session::put('foto_profil', $createUserGoogle->foto_profil);
                    Session::put('status', $createUserGoogle->status_member);
                    Session::put('is_active', $createUserGoogle->is_active);
                    Session::put('is_google',$createUserGoogle->is_google);
                    Session::put('profil_saya',$createUserGoogle->tentang_saya);
                    return redirect('/');
                }else{
                    return 'data ndak masuk';
                }
            }

        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
    }
}
