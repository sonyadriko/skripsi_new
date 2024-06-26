@extends('layout.master')

@section('title', 'Daftar Sidang Proposal')

@push('plugin-styles')
<!-- Menambahkan stylesheet untuk flatpickr dan jquery-steps -->
<link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/jquery-steps/jquery.steps.css') }}" rel="stylesheet" />
@endpush

@section('content')
<style>
    .wizard > .content {
        min-height: 50em; /* Mengatur tinggi minimum konten wizard */
    }
</style>
<!-- Menampilkan pesan sukses jika ada -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<!-- Breadcrumb untuk navigasi halaman -->
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sidang Proposal Skripsi</li>
    </ol>
</nav>
<!-- Informasi untuk menyelesaikan bimbingan proposal -->
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-warning" role="alert">
            Harap menyelesaikan bimbingan proposal sampai di acc oleh dosen pembimbing.
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
<!-- Menambahkan script untuk jquery-steps dan sweetalert2 -->
<script src="{{ asset('assets/plugins/jquery-steps/jquery.steps.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@push('custom-scripts')
<!-- Tempat untuk menambahkan script kustom jika diperlukan -->
@endpush
