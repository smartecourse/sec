<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* use App\Mail\TransactionSuccess; */
use App\Models\Transaksi;
/* use Illuminate\Support\Facedes\Mail; */
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PembayaranController extends Controller
{
    public function notif(Request $request){
        try {
            //setConfig
            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction');
            Config::$isSanitized = config('midtrans.isSanitized');
            Config::$is3ds = config('midtrans.is3ds');

            //Notification Midtrans
            $notification = new Notification();
            $status = $notification->transaction_status;
            $type = $notification->payment_type;
            $fraud = $notification->fraud_status;
            $order_id = $notification->order_id;

            //getTransaction
            $transaction = Transaksi::findOrFail($order_id);
            if($status == 'capture'){
                if($type == 'credit_card'){
                    if($fraud == 'challenge'){
                        $transaction->status = 'ditolak';
                        $transaction->metode_pembayaran = $type;
                    } else {
                        $transaction->status = 'disetujui';
                    }
                }
            } else if($status == 'settlement') {
                $transaction->status = 'disetujui';
                $transaction->metode_pembayaran = $type;
            } else if($status == 'pending') {
                $transaction->status = 'sedang diproses';
            } else if($status == 'expire') {
                $transaction->status = 'ditolak';
            } else if($status == 'cancel') {
                $transaction->status = 'ditolak';
            } else if($status == 'deny') {
                $transaction->status = 'ditolak';
            }

            $transaction->save();
        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

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
