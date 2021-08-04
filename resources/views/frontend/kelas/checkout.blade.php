@extends('frontend.layouts.template')
@section('content')
    <section class="bg-100 py-700" id="kelas">
        {{-- <div class="container text-center m-4"> --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="content-kelas h-100 position-relative" style="margin-bottom: 250px">
                        {{-- <h4 class="card-title">{{ $kelas->judul_kelas }}</h4> --}}
                        <h4 class="card-title">Pembayaran untuk </h4>
                        <div class="table-responsive">
                            <table class="table mb-0">
                              <thead>
                                <tr>
                                  <th class="text-center">Item</th>
                                  <th class="text-center">Harga</th>
                                  <th class="text-center">Diskon</th>
                                  <th class="text-center">Subtotal</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="text-center text-bold-500">{{ $kelas->nama_jenis_kelas }} - {{ $kelas->nama_paket }}</td>
                                  <td style="text-align: right;">Rp.{{ number_format($kelas->harga, 2, ',', '.') }}</td>
                                  <td class="text-center text-bold-500">{{ $kelas->diskon }}%</td>
                                  @php
                                    $nowPrice = $kelas->harga - ($kelas->harga * $kelas->diskon / 100);
                                  @endphp
                                  <td style="text-align: right;">Rp.{{ number_format($nowPrice, 2, ',' , '.') }}</td>                      
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="d-flex justify-content-end bd-highlight mt-4 mb-2">
                            <div>
                                <form action="{{ route('checkout', $kelas->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-fill text-white">Beli Kelas</button>
                                </form>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    </section>
@endsection
