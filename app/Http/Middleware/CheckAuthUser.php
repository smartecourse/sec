<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckAuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {  
        // $e = $request->session();
        // if (!$request->session()->exists('user')) {
        //     // user value cannot be found in session
        //     return redirect('/');
        // }
        // $a = session('token');
        // return $a;
        // if(session('token') == null) {
        //     // belum login
        //     return 'asd';
        //     return redirect('/');
        // }
        // if(!Session::has('token')) {
        //     // belum login
        //     return 'belum login'.dd(Session::all());
        // }
        // if(!Auth::check()) {
        //     // return 'login';
        //     return view('frontend.auth.login');
        // }

        return $next($request);
        // if(Session::get('token') != null) {
        //     // sudah login
        //     return 'sudah login';
        //     return $next($request);
        // }
        // else {
        //     // belum login
        //     $se = Session::get('token');
        //     return 'token : '.$se;
        //     return 'belum login';
        //     return redirect()->back();
        // }

    }
}
