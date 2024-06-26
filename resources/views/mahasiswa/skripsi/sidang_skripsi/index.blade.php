@extends('layout.master3')

@section('title', 'Daftar Sidang Skripsi')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sidang Skripsi</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
        @if(is_null($datas) || is_null($datas->id_bimbingan_skripsi))
        <div class="alert alert-warning" role="alert">
            Harap menyelesaikan tahap proposal terlebih dahulu.
        </div>
        @else
            @if($datas->dosen_pembimbing_ii == 'tidak ada' && is_null($datas->acc_dosen_utama))
            <div class="alert alert-warning" role="alert">
                Harap melakukan pengajuan judul terlebih dahulu.
            </div>
            @elseif($datas->status == 'pending')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Sidang Proposal </h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-0">Pendaftaran Sidang Proposal Skripsi telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dibuatkan jadwal.</h6>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-secondary" role="alert">
                            Tunggu diperiksa koordinator.
                        </div>
                    </h6>
                </div>
            </div>
            @elseif($datas->status == 'terima')
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pengajuan Sidang Proposal </h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title mb-0">Pendaftaran Seminar Proposal Skripsi telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dibuatkan jadwal.</h6>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-success" role="alert">
                            Selamat.
                        </div>
                    </h6>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Alur Pendaftaran Sidang Skripsi</h4>
                </div>
                <div class="card-body">
                    <h6 class="mb-4">Langkah-langkah yang harus dilalui saat ingin melakukan pendaftaran sidang skripsi.</h6>

                    <div id="basic-pills-wizard" class="twitter-bs-wizard">
                        <ul class="twitter-bs-wizard-nav d-flex justify-content-center">
                            <li class="nav-item">
                                <a href="#seller-details" class="nav-link disable-click" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Step Pertama">
                                        <i class="bx bx-list-ul"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#bank-detail" class="nav-link disable-click" data-toggle="tab">
                                    <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Step Kedua">
                                        <i class="bx bxs-bank"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- wizard-nav -->
                        <div class="tab-content twitter-bs-wizard-tab-content">
                            <div class="tab-pane" id="seller-details">
                                <div class="text-center mb-4">
                                    <h5>Step Pertama</h5>
                                    <p class="card-title-desc">Membaca urutan dari apa yang harus dilakukan dan dipersiapkan untuk melakukan pendaftaran sidang skripsi terdapat pada gambar dibawah ini.</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">

                                        </div>
                                    </div>
                                </div>
                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                    <li class="next"><a href="javascript: void(0);" class="btn btn-primary" >Next <i
                                                class="bx bx-chevron-right ms-1"></i></a></li>
                                </ul>
                            </div>
                            <!-- tab pane -->
                            <div class="tab-pane" id="bank-detail">
                                <div>
                                    <div class="text-center mb-4">
                                        <h5>Step Kedua</h5>
                                        <p class="card-title-desc">Melakukan pengisian form pendaftaran seminar dibawah ini.</p>
                                    </div>
                                    <form action="{{route('sidang_skripsi.store')}}" method="POST" enctype="multipart/form-data" id="yourFormId">
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
                                        <input type="hidden" name="id_bimbingan_skripsi" value="{{$datas->id_bimbingan_skripsi}}">
                                        <div class="mb-3">
                                            <label for="skripsi_file" class="form-label">Upload File Skripsi</label>
                                            <input class="form-control" type="file" name="skripsi_file" id="skripsi_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('skripsi_file')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="slip_file" class="form-label">Upload File Slip Pembayaran Sidang Skripsi</label>
                                            <input class="form-control" type="file" name="slip_file" id="slip_file" />
                                            <p class="text-danger"> File : PDF | Size Max : 1MB.</p>
                                            @error('slip_file')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>
                                    <ul class="pager wizard twitter-bs-wizard-pager-link">
                                        <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i
                                                    class="bx bx-chevron-left me-1"></i> Previous</a></li>
                                        <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" onclick="showConfirmation()">Save
                                                Changes</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            @endif
            <!-- end card -->
        @endif
    </div>
    <!-- end col -->
</div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets2/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/libs/twitter-bootstrap-wizard/twitter-bootstrap-wizard.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/app.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi untuk berpindah ke tab selanjutnya
        function nextTab() {
            var nextTab = $('.nav-item.active').next('li.nav-item');
            if (nextTab.length > 0) {
                nextTab.find('a.nav-link').click();
            }
        }

        // Fungsi untuk kembali ke tab sebelumnya
        function previousTab() {
            var prevTab = $('.nav-item.active').prev('li.nav-item');
            if (prevTab.length > 0) {
                prevTab.find('a.nav-link').click();
            }
        }

        // Fungsi untuk menampilkan konfirmasi sebelum menyimpan perubahan
        function showConfirmation() {
            var proposalFile = $('#skripsi_file').val();
            var slipFile = $('#slip_file').val();

            if (proposalFile === '' || slipFile === '') {
                Swal.fire({
                    title: 'Error',
                    text: 'Please upload both proposal and slip files before saving changes.',
                    icon: 'error',
                });
            } else {
                Swal.fire({
                    title: 'Konfirmasi?',
                    text: 'Apakah Anda ingin menyimpan perubahan?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        saveChanges();
                    }
                });
            }
        }

        // Fungsi untuk menyimpan perubahan
        function saveChanges() {
            var form = $('#yourFormId')[0]; // Ganti 'yourFormId' dengan ID form yang sesungguhnya
            form.submit();
        }

        // Fungsi yang dijalankan saat dokumen siap
        $(document).ready(function () {
            // Inisialisasi wizard
            $('#basic-pills-wizard').bootstrapWizard({
                onTabClick: function (tab, navigation, index) {
                    return true;
                },
                onNext: function (tab, navigation, index) {
                    return true;
                },
                onPrevious: function (tab, navigation, index) {
                    return true;
                },
                onTabShow: function (tab, navigation, index) {
                }
            });
        });
    </script>
@endsection
