@extends('layouts/template')

@section('title')
Proposal
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
        <h5 class="card-header">Daftar Seminar Proposal</h5>
        <div class="card-body">
          <form action="{{route('seminar-proposal.submit')}}" method="POST" enctype="multipart/form-data">
            {{-- <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">No Bimbingan</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="xx.xxx.xxx"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div> --}}
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">NPM</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="13.2019.1.00819"
                  value="13.2019.1.00819"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Nama Mahasiswa</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  value="Sony Adi Adriko"
                  placeholder="Sony Adi Adriko"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Judul</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  value="Data mining untuk kehidupan yang lebih baik"
                  placeholder="Sistem pendukung keputusan "
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 1</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Dosen Pembimbing 1"
                  value="Dosen Pembimbing 1"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="defaultFormControlInput" class="form-label">Dosen Pembimbing 2</label>
                <input
                  type="text"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="Dosen Pembimbing 2"
                  value="tidak ada"
                  aria-describedby="defaultFormControlHelp"
                  readonly
                />
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File Proposal Skripsi</label>
                <input class="form-control" type="file" id="proposal_file" />
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload File Slip Pembayaran Seminar Proposal</label>
                <input class="form-control" type="file" id="slip_file" />
            </div>
        <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </form>
      </div>
    </div>
</div>


@endsection