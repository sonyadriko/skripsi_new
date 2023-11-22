@extends('layouts/template')

@section('title')
Daftar Sidang Skripsi
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if(is_null($datas) || is_null($datas->id_bimbingan_proposal))

    <div class="alert alert-warning" role="alert">
        Harap selesaikan proposal terlebih dahulu.
    </div>
    @else
      <div class="card mb-4">
          <h5 class="card-header">Daftar Sidang Skripsi</h5>
          <div class="card-body">
            <form action="{{route('sidang_skripsi.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label for="npm" class="form-label">NPM</label>
                  <input type="text" class="form-control" id="npm" value="{{Auth::user()->kode_unik}}" name="npm" aria-describedby="defaultFormControlHelp"readonly/>
              </div>
              <div class="mb-3">
                  <label for="nama" class="form-label">Nama Mahasiswa</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{Auth::user()->name}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                  <label for="dospem1" class="form-label">Dosen Pembimbing 1</label>
                  <input type="text" class="form-control" id="dospem1" value="{{$datas->dosen_pembimbing_utama}}" placeholder="Dosen Pembimbing 1" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              <div class="mb-3">
                  <label for="dospem2" class="form-label">Dosen Pembimbing 2</label>
                  <input type="text" class="form-control" id="dospem2" placeholder="Dosen Pembimbing 2" value="{{$datas->dosen_pembimbing_ii}}" aria-describedby="defaultFormControlHelp" readonly />
              </div>
              {{-- <input type="hidden" name="user_id" value="{{Auth::user()->id}}"> --}}
              <input type="hidden" name="id_bimbingan_skripsi" value="{{$datas->id_bimbingan_skripsi}}">
              <div class="mb-3">
                  <label for="skripsi_file" class="form-label">Upload File Skripsi</label>
                  <input class="form-control" type="file" name="skripsi_file" id="skripsi_file" />
              </div>
              <div class="mb-3">
                  <label for="slip_file" class="form-label">Upload File Slip Pembayaran Sidang Skripsi</label>
                  <input class="form-control" type="file" name="slip_file" id="slip_file" />
              </div>
          <div class="d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
            </form>
        </div>
      </div>
      @endif
</div>


@endsection