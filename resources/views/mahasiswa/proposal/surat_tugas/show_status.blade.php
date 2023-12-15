@extends('layout.master')

@section('title')
Daftar Surat Tugas
@endsection

@push('plugin-styles')
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
<style>
    .wizard > .content {
        min-height: 50em; /* Menggunakan auto untuk menghilangkan batasan minimum tinggi */
    }
</style>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Forms</a></li>
        <li class="breadcrumb-item active" aria-current="page">Surat Tugas Bimbingan</li>
    </ol>
</nav>
<div class="row">
    <div class="col-lg-12">
            @if ($datas->status == 'pending')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-0">Pendaftaran Surat Tugas telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dicetak.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-secondary mt-3" role="alert">
                            Tunggu diperiksa koordinator.
                        </div>
                    </h4>
                </div>
            </div>
            @elseif ($datas->status == 'terima')
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="card-title mb-3" style="font-weight: bold">Pendaftaran Surat Tugas telah disubmit.</h4>
                    <h6 class="mb-3">Pendaftaran yang anda lakukan akan dicek terlebih dahulu oleh koordinator, lalu akan dicetak.</h4>
                    <h6 class="mb-3">Status Pendaftaran :
                        <div class="alert alert-success mt-3" role="alert">
                            Selamat, Pengajuan surat tugas anda sudah di acc. Surat tugas dapat diambil di CSR Jurusan.
                        </div>
                    </h4>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Detail Surat Tugas.</h4>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">NPM</label>
                                <p><span>{{ $datas->kode_unik }}</span></p>
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Nama</label>
                                <p><span>{{ $datas->name }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Tema / Judul</label>
                                <p><span>{{ $datas->judul }}</span></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Nomor Surat Tugas</label>

                                <p><span>{{ $datas->nomor_surat_tugas }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Tanggal Terbit</label>
                                @php
                                    $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_terbit);
                                    $formatTanggal = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                @endphp
                                <p><span>{{ $formatTanggal }}</span></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: bold">Tanggal Kadaluwarsa</label>
                                @php
                                        $carbonTanggal = \Carbon\Carbon::parse($datas->tanggal_kadaluwarsa);
                                        $formatTanggal2 = $carbonTanggal->formatLocalized('%A, %d %B %Y', 'id');
                                    @endphp
                                <p><span>{{ $formatTanggal2 }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

{{-- !-- row --> --}}
@endsection
@push('plugin-scripts')
<script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')

@endpush