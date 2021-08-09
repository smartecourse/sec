<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Kelas;
use App\Models\Paket;
use App\Models\JenisKelas;
use App\Models\KebijakanPrivasi;
use App\Models\KelasAktif;
use App\Models\Materi;
use App\Models\MateriKonten;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\ReviewKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Midtrans\Config;
use Midtrans\Snap;

class LandingPageController extends Controller
{
    private $param;

    public function index()
    {
        $this->param['paket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas', 'kelas_jenis.deskripsi AS deskripsi_jenis')
                                    ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                    ->groupBy('kelas_jenis.nama_jenis_kelas')
                                    ->get();
        /* dd($this->param['paket']); */
        // return $this->param;
        return view('frontend.landing-page', $this->param);
    }
    
    public function tentangKami()
    {
        return view('frontend.tentang-kami.tentang-kami');
    }
    public function katalogKelas()
    {
        // $this->param['paket'] = Kelas::select('kelas.id  AS id_kelas','kelas.kode_kelas','judul_kelas','kelas.slug as slug_kelas','kelas.deskripsi','kelas.intro','kelas.intro_link','kelas.cover','kelas.by_author',
        //                             'paket.id AS id_paket','paket.nama_paket','paket.slug AS slug_paket ','paket.kelas_jenis_id','paket.cover','paket.diskon','paket.harga','paket.deadline','paket.link_zoom','paket.group_whatsapp',
        //                             'kelas_jenis.id as id_kelas_jenis','kelas_jenis.nama_jenis_kelas')
        //                             ->join('paket','kelas.paket_id','paket.id')
        //                             ->join('kelas_jenis','paket.kelas_jenis_id','kelas_jenis.id')
        //                             ->orderBy('kelas.id','ASC')
        //                             ->paginate(4);
        $this->param['paket'] = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')
                                    ->join('kelas', 'kelas.paket_id', 'paket.id')
                                    ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                    ->groupBy('paket.id')
                                    ->get();

        $this->param['fasilitas'] = Fasilitas::join('kelas_jenis', 'kelas_jenis.id', 'fasilitas_kelas.id_paket')->get();

        $this->param['jenis'] = JenisKelas::select('nama_jenis_kelas', 'deskripsi')->orderBy('bobot', 'DESC')->get();

        // return $this->param['fasilitas'];

        return view('frontend.kelas.kelas',$this->param);
    }
    public function detailKelas($slug)
    {
        $idPaket = Paket::where('slug', $slug)->first()->id;
            
        // $this->param['paket'] = Paket();
        $this->param['fasilitas'] = Fasilitas::where('id_paket', $idPaket)->orderBy('fasilitas', 'ASC')->get();


        $this->param['kelas'] = Kelas::select('kelas.id  AS id_kelas','kelas.kode_kelas','judul_kelas','kelas.slug as slug_kelas', 'kelas.tipe_kelas', 'kelas.deskripsi','kelas.intro','kelas.intro_link','kelas.cover','kelas.by_author','kelas.pdf_file',
                                    'paket.id AS id_paket','paket.nama_paket','paket.slug AS slug_paket ','paket.kelas_jenis_id','paket.slug AS paket_slug','paket.cover','paket.diskon','paket.harga','paket.deadline','paket.link_zoom','paket.group_whatsapp',
                                    'kelas_jenis.id as id_kelas_jenis','kelas_jenis.nama_jenis_kelas')
                                     ->join('paket','kelas.paket_id','paket.id')
                                     ->join('kelas_jenis','paket.kelas_jenis_id','kelas_jenis.id')
                                     ->where('kelas.paket_id', $idPaket)
                                     ->orderBy('kelas.tipe_kelas', 'DESC')
                                     ->get();
                                    //  return $this->param['kelas'];

        $this->param['review'] = ReviewKelas::select('review_kelas.*',
                                                    'kelas.id AS id_kelas','kelas.paket_id',
                                                    'users.id AS id_users','users.nama', 'users.foto_profil')
                                                ->join('users','users.id', 'review_kelas.id_user')
                                                ->join('kelas','kelas.id','review_kelas.id_kelas')
                                              ->where('kelas.paket_id', $idPaket)
                                              ->orderBy('review_kelas.created_at', 'DESC')
                                              ->get();
        // return $this->param['review'];
        return view('frontend.kelas.detail-kelas', $this->param);
    }
    public function checkout($slug)
    {
        if(!Session::has('token')) {
            // sudah login
            return redirect('/login');
        }
        $paket = Paket::select('paket.*', 'kelas_jenis.nama_jenis_kelas')->join('kelas_jenis','paket.kelas_jenis_id','kelas_jenis.id')->where('slug', $slug)->first();

        $this->param['kelas'] = $paket;
        // $this->param['kelas'] = Kelas::select('kelas.id  AS id_kelas','kelas.kode_kelas','judul_kelas','kelas.slug as slug_kelas', 'kelas.tipe_kelas', 'kelas.deskripsi','kelas.intro','kelas.intro_link','kelas.cover','kelas.by_author','kelas.tipe_kelas','kelas.pdf_file',
        //                             'paket.id AS id_paket','paket.nama_paket','paket.slug AS slug_paket ','paket.kelas_jenis_id','paket.cover','paket.diskon','paket.harga','paket.deadline','paket.link_zoom','paket.group_whatsapp',
        //                             'kelas_jenis.id as id_kelas_jenis','kelas_jenis.nama_jenis_kelas')
        //                              ->join('paket','kelas.paket_id','paket.id')
        //                              ->join('kelas_jenis','paket.kelas_jenis_id','kelas_jenis.id')
        //                              ->where('kelas.paket_id', $idPaket)
        //                              ->orderBy('kelas.tipe_kelas', 'DESC')
        //                              ->first();

        return view('frontend.kelas.checkout', $this->param);
    }
    public function checkoutProcess($id)
    {
        // $date = date('Y-m-d');
        // $deadline = array(
        //     'durasi' => 30,
        //     'sekarang' => $date,
        //     'tenggat waktu' => date('Y-m-d', strtotime("+30 days", strtotime($date)))
        // );

        if(!Session::has('token')) {
            return redirect('/login');
        }

        try {
            $currentTransaction = Transaksi::where('user_id', Session::get('id_user'))
                                            ->where('paket_id', $id)
                                            ->where('is_active', 'active')
                                            ->count();

            if($currentTransaction > 0) {
                // user sudah pernah membeli kelas
                return redirect()->back()->withStatus('Informasi', 'Anda sudah pernah membeli kelas ini');
            }
            else {
                // user dapat membeli kelas
                $user = User::find(Session::get('id_user'));
                $paket = Paket::find($id);

                $date = date('Ymd');

                /* Generate Transaction Code */
                // Format Kode INV202106260001
                $kodeTransaksi = null;
                $transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
                if($transaksi->count() > 0) {
                    $kodeTransaksi = $transaksi[0]->kode_transaksi;

                    $lastIncrement = substr($kodeTransaksi, 11);

                    $kodeTransaksi = str_pad($lastIncrement + 1, 4, 0, STR_PAD_LEFT);
                    $kodeTransaksi = "INV".$date.$kodeTransaksi;
                }
                else {
                    $kodeTransaksi = "INV".$date."0001";
                }
                /* END Generate Transaction Code */
                $newTransaksi = new Transaksi;
                $newTransaksi->kode_transaksi = $kodeTransaksi;
                $newTransaksi->user_id = Session::get('id_user');
                $newTransaksi->paket_id = $paket->id;
                if($paket->diskon > 0) {
                    // ada diskon
                    $newTransaksi->diskon = $paket->diskon;
                    $totalDiskon = $paket->harga * ($paket->diskon / 100);
                    $harga = $paket->harga - $totalDiskon;
                    $newTransaksi->grand_total = $harga;
                }
                else {
                    // tidak ada diskon
                    $newTransaksi->grand_total = $paket->harga;
                }
                $deadline = date('Y-m-d', strtotime("+$paket->deadline days", strtotime($date)));
                $newTransaksi->tanggal_deadline = $deadline;
                $newTransaksi->status = 'sedang diproses';
                //$newTransaksi->status = 'disetujui';
                $newTransaksi->is_active = 'deactive';
                //$newTransaksi->is_active = 'active';
                $newTransaksi->save();

                if($newTransaksi->save()) {
                    /* Tambah ke kelas aktif */
                    $kelas = Kelas::where('paket_id', $paket->id)->get();
                    foreach ($kelas as $value) {
                        $newKelasAktif = new KelasAktif;
                        $newKelasAktif->kelas_id = $value->id;
                        $newKelasAktif->user_id = $user->id;
                        $newKelasAktif->deadline = $newTransaksi->tanggal_deadline;
                        $newKelasAktif->is_active = "active";
                        $newKelasAktif->save();
                    }
                    /* END Tambah ke kelas aktif */
                    // Set konfigurasi midtrans
                    Config::$serverKey = config('midtrans.serverKey');
                    Config::$isProduction = config('midtrans.isProduction');
                    Config::$isSanitized = config('midtrans.isSanitized');
                    Config::$is3ds = config('midtrans.is3ds');

                    // Deklarasi array untuk dikirim ke midtrans
                    $midtrans_params = [
                        'transaction_details' => [
                            'order_id' => $newTransaksi->kode_transaksi,
                            'gross_amount' => (int) $newTransaksi->grand_total,
                        ],
                        'customer_details' => [
                            'first_name' => $user->nama,
                            'email' => $user->email
                        ],
                        'item_details' => array(
                            array(
                                'id' => (string) $newTransaksi->paket_id,
                                'price' => (int) $newTransaksi->grand_total,
                                'quantity' => 1,
                                'name' => $paket->nama_paket
                            )
                        ),
                        // 'enabled_payments' => ['gopay'],
                        'enabled_payments' => ['cimb_clicks',
                            'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va',
                            'bca_va', 'bni_va', 'bri_va', 'other_va', 'gopay', 'indomaret',
                            'danamon_online', 'akulaku', 'shopeepay'],
                        'vtweb' => []
                    ];

                    // Ambil halaman payment midtrans
                    $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

                    // Redirect to Snap Payment Page
                    return redirect($paymentUrl);
                }
                $getStatusMember = Paket::select('kelas_jenis.nama_jenis_kelas', 'kelas_jenis.bobot')
                                        ->join('kelas_jenis', 'kelas_jenis.id', 'paket.kelas_jenis_id')
                                        ->join('transaksi', 'transaksi.paket_id', 'paket.id')
                                        ->where('transaksi.user_id', Session::get('id_user'))
                                        ->orderBy('kelas_jenis.bobot', 'DESC')
                                        ->get();
                
                $currentStatusMember = $getStatusMember[1]->bobot;
                $newStatusMember = $getStatusMember[0]->bobot;
                if($newStatusMember > $currentStatusMember) {
                    // jika bobot jenis kelas lebih besar dari bobot jenis kelas sebelumnya
                    $user->status_member = strtolower($getStatusMember[0]->nama_jenis_kelas);
                    $user->save();
                    Session::put('status_member', $newStatusMember);
                }
            }

        } catch (\Exception $e) {
            $response = $e->getMessage();
            return $response;
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }

    public function login()
    {
        if(Session::has('token')) {
            // sudah login
            return redirect()->back();
        }
        return view('frontend.auth.login');
    }
    public function logout(Request $request)
    {
        Session::flush();

        return redirect('/');
    }
    public function registrasi()
    {
        return view('frontend.registrasi');
    }

    public function kebijakanPrivasi()
    {
        $this->param['kebijakan'] = KebijakanPrivasi::first();

        return view('frontend.kebijakan-privasi', $this->param);
    }
}
