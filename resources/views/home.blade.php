@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('title')
Dashboard
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
</div>
<h6 class="mb-4">Halaman ini merupakan dashboard Sistem Monitoring Skripsi</h6>



<div class="row">
    <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6>Progress Skripsi</h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $progressPercentage }}%</div>
                </div>
                {{-- <div class="progress-text">
                    <ul class="list-inline" style="display: flex;width: {{ $progressPercentage }}%;">
                        @foreach($tables as $table)
                            <li class="list-inline-item">{{ $table }}</li>
                        @endforeach
                    </ul>
                </div> --}}






            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xl-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Info Penting</h6>
                </div>
                <div class="col-lg-5 col-xl-4 grid-margin stretch-card mx-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            <img src="{{ asset('img/undraw_add_information_j2wg.svg') }}" alt="Additional Information" class="img-fluid mx-auto" style="width: 100%; max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>

                <p class="text-muted mb-2">Pengajuan proposal skripsi hanya dapat dilakukan oleh mahasiswa yang sudah melewati semester 6, dan sudah menempuh mata kuliah yang akan dijadikan sebagai topik proposal skripsi.</p>
                <p>Lihat lebih banyak</p>
            </div>
        </div>
    </div>
</div>


{{-- !-- row --> --}}
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
