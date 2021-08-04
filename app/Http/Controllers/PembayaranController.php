<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function finish()
    {
        return view('frontend.pembayaran.finish');
    }

    public function unfinish()
    {
        return view('frontend.pembayaran.unfinish');
    }

    public function error()
    {
        return view('frontend.pembayaran.error');
    }
}
