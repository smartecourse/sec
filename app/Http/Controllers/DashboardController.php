<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Transaksi;
use Auth;

class DashboardController extends Controller
{
    private $param;
    public function __construct()
    {
        $this->middleware(['role:admin|users']);
        $this->param['onSide'] = 'dashboard';
    }

    public function index()
    {
        // if(Auth::user()->hasRole('admin'))
        // {
        //     $this->param['getUsers'] = User::role('users')->count();
        //     $this->param['getAdmin'] = User::role('admin')->count();
        //     $this->param['getKelas'] = Kelas::count();
        //     $this->param['getTransaksiSuccess'] = Transaksi::where('status', 'disetujui')->count();
        //     $this->param['getTransaksiProcess'] = Transaksi::where('status', 'sedang diproses')->count();
        //     return view('admin.page.dashboard', $this->param);
        // } elseif (Auth::user()->hasRole('users')) {
        //     echo "users";
        //     return view('auth.login')->with('message', Auth::user()->role.'Akun ini tidak memiliki hak akses.');
        // } else {
        //     echo "no role";
        // }

        if(Auth::user()->hasRole('admin'))
        {
            $this->param['getUsers'] = User::role('users')->count();
            $this->param['getAdmin'] = User::role('admin')->count();
            $this->param['getKelas'] = Kelas::count();
            $this->param['getTransaksiSuccess'] = Transaksi::where('status', 'disetujui')->count();
            $this->param['getTransaksiProcess'] = Transaksi::where('status', 'sedang diproses')->count();
            $this->param['getTransaksiCanceled'] = Transaksi::where('status', 'ditolak')->count();
            $this->param['getGrandTotal'] = Transaksi::select(\DB::raw('SUM(grand_total) AS total'))
                                                            ->where('status', 'disetujui')
                                                            ->first();
            $this->param['getGrandTotalToday'] = Transaksi::select(\DB::raw('SUM(grand_total) AS total'))
                                                            ->where('updated_at', 'LIKE', date('Y-m-d').'%')
                                                            ->where('status', 'disetujui')
                                                            ->first();
            $year = date('Y');

            $this->param['transaksi'] = Transaksi::select(\DB::raw('SUM(grand_total) AS total'), \DB::raw("DATE_FORMAT(updated_at, '%m') month"))
                                                ->whereYear('updated_at', $year)
                                                ->groupBy('month')
                                                ->get();
                                                            
            return view('admin.page.dashboard', $this->param);
        } else {
            // jika role adalah user atau tidak mempunyai role
            // echo "no role";
            Auth::logout();

            return view('auth.login')->with('message', 'Akun ini tidak memiliki hak akses.');
        }
    }
}
