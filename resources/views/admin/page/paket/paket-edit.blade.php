@extends('admin.core.core-dashboard')

@section('onPage', 'Edit Paket')
@section('content')
<div class="row">
    @if (session('status'))
        <div class="alert alert-success sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('status')}}
            </div>
        </div>
    @elseif (session('error') && session('error') != 'The given data was invalid.')
        <div class="alert alert-danger sb-alert-icon m-3 w-100" role="alert">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <div class="sb-alert-icon-content">
                {{session('error')}}
            </div>
        </div>
    @endif
</div>
<div class="row">
    <div class="col">
        <a href="{{route('paket.index')}}">
            <button class="btn btn-primary btn-icon-split mb-3 float-left">
                <span class="icon text-white">
                    <i class="fas fa-arrow-left"></i>&nbsp;Lihat Data
                </span>
            </button>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form Edit Paket</h6>
            </div>
            <form class="card-body" method="POST" action="{{route('paket.update', $getPaket->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama_paket" class="ml-1">Nama Paket<span class="text-danger">*</span> :</label>
                    <input type="text" class="form-control  @error('nama_paket') is-invalid @enderror" name="nama_paket" placeholder="ex : Reguler" value="{{$getPaket->nama_paket}}" autocomplete="off">
                    @error('nama_paket')
                        <p class="text-dager">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelas" class="ml-1">Jenis Kelas<span class="text-danger">*</span> :</label>
                    <select class="custom-select" name="jenis_kelas">
                        <option value="0">Pilih Jenis Kelas</option>
                        @foreach ($jenisKelas as $item)
                        <option value="{{ $item->id }}" @if(old('jenis_kelas', $getPaket->kelas_jenis_id) == $item->id ) selected @endif>{{ $item->nama_jenis_kelas }}</option>                            
                        @endforeach
                    </select>
                    @error('jenis_kelas')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cover">Sampul</label><br>
                    <a style="cursor: pointer;" data-toggle="modal" class="showDetailData" data-target=".modal-show-detail" data-image="{{ url('', $getPaket->cover) }}">
                        <img src="{{ asset($getPaket->cover != null ? $getPaket->cover : 'admin/img/no_image_available.jpeg') }}" class="rounded mr-4" width="240" height="240" alt="">
                    </a>
                    <br><br>
                    <input type="file" name="cover" id="cover">
                    @error('cover')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga" class="ml-1">Harga<span class="text-danger">*</span> :</label>
                    <input type="number" class="form-control  @error('harga') is-invalid @enderror" name="harga" placeholder="ex : 30000" value="{{old('harga', $getPaket->harga)}}" autocomplete="off">
                    @error('harga')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="diskon" class="ml-1">Diskon - % (opsional) :</label>
                    <input type="number" class="form-control  @error('diskon') is-invalid @enderror" name="diskon" placeholder="ex : 30" value="{{old('diskon', $getPaket->diskon)}}" autocomplete="off">
                    @error('diskon')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deadline" class="ml-1">Masa berlaku (hari)<span class="text-danger">*</span> :</label>
                    <input type="number" class="form-control  @error('deadline') is-invalid @enderror" name="deadline" placeholder="ex : 30" value="{{old('deadline', $getPaket->deadline)}}" autocomplete="off">
                    @error('deadline')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="link_zoom" class="ml-1">Link Zoom (opsional) :</label>
                    <input type="text" class="form-control  @error('link_zoom') is-invalid @enderror" name="link_zoom" placeholder="ex : https://us04web.zoom.us/wc/71759035374/start" value="{{old('link_zoom', $getPaket->link_zoom)}}" autocomplete="off">
                    @error('link_zoom')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="group_whatsapp" class="ml-1">Grup Whatsapp (opsional) :</label>
                    <input type="text" class="form-control  @error('group_whatsapp') is-invalid @enderror" name="group_whatsapp" placeholder="ex : https://chat.whatsapp.com/BTydSElUIQS9RA6MsCOtfP" value="{{old('group_whatsapp', $getPaket->group_whatsapp)}}" autocomplete="off">
                    @error('group_whatsapp')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-inline float-right">
                    <button class="btn btn-danger btn-icon-split mt-2 mr-2" type="reset">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        <span class="text">Batal</span>
                    </button>
                    <button class="btn btn-primary btn-icon-split mt-2" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal modal-show-detail">
    <div class="modal-dialog" style="max-width: 50% !important;">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          {{-- <h6 class="modal-title">Detail Data</h6> --}}
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body text-center">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <img alt="" class="rounded" id="showDetail" width="100%">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@section('extraJS')
<script>
    $(document).ready(function() {
        $('.showDetailData').click(function (e) { 
            let imageSrc = $(this).data('image');
            $('.modal-body #showDetail').attr('src', imageSrc);
        });
    });
</script>
@endsection