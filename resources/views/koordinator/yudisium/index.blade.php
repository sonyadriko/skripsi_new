@extends('layout.master3')

@section('title')
Yudisium
@endsection

@section('css')
<link href="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Manajemen</a></li>
      <li class="breadcrumb-item active" aria-current="page">Status Kelulusan</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="font-weight: bold">Status Kelulusan Mahasiswa</h4>
                <p class="card-title-desc">Tabel ini menampilkan list mahasiswa yang sudah daftar yudisium, dan juga terdapat tombol detail untuk menginputkan statusnya.
                </p>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Bidang Ilmu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $no=1;
                        @endphp
                        @foreach($yudisium as $yudisium)

                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $yudisium->name }}</td>
                            <td>{{ $yudisium->kode_unik }}</td>
                            <td>{{ $yudisium->topik_bidang_ilmu }}</td>
                            {{-- <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal{{ $yudisium->id_yudisium }}">
                                    Status
                                </button>
                            </td> --}}
                            <td><a href="{{ url('/koordinator/yudisium/detail/' . $yudisium->id_yudisium) }}" class="btn btn-primary">Detail</a></td>
                        </tr>
                        {{-- <div class="modal fade" id="statusModal{{ $yudisium->id_yudisium }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel{{ $yudisium->id_yudisium }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusModalLabel{{ $yudisium->id_yudisium }}">Ubah Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form status di sini -->
                                        <form action="{{ url('/koordinator/surat_tugas/update-status/' . $yudisium->id_yudisium) }}" method="post">
                                            @csrf
                                            <label for="status">Pilih Status:</label>
                                            <select name="status" class="form-control">
                                                <option value="terima">Terima</option>
                                                <option value="tolak">Tolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @php
                        $no++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush

@section('script')
<script src="{{ asset('assets2/libs/datatables.net/datatables.net.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-bs4/datatables.net-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons/datatables.net-buttons.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-buttons-bs4/datatables.net-buttons-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets2/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive/datatables.net-responsive.min.js') }}"></script>
<script src="{{ asset('assets2/libs/datatables.net-responsive-bs4/datatables.net-responsive-bs4.min.js') }}"></script>
<script src="{{ asset('assets2/js/pages/datatables.init.js') }}"></script>
<script src="{{ asset('assets2/js/app.min.js') }}"></script>
@endsection
