<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KoordinatorBeritaAcaraSkripsiController extends Controller
{
    public function index()
    {
        $baskripsi = DB::table('berita_acara_skripsi')
        ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
        ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
        ->get();

    return view('koordinator/berita_acara/sidang.index', compact('baskripsi'));
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('berita_acara_skripsi')

                ->join('users', 'users.id', 'berita_acara_skripsi.users_id')
                ->join('sidang_skripsi', 'sidang_skripsi.id_sidang_skripsi', 'berita_acara_skripsi.sidang_skripsi_id')
                ->join('users as penguji1', 'penguji1.id', 'sidang_skripsi.dosen_penguji_1')
                ->join('users as penguji2', 'penguji2.id', 'sidang_skripsi.dosen_penguji_2')
                ->join('users as penguji3', 'penguji3.id', 'sidang_skripsi.dosen_penguji_3')
                ->join('bimbingan_skripsi', 'bimbingan_skripsi.id_bimbingan_skripsi', 'sidang_skripsi.bimbingan_skripsi_id')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_berita_acara_s', '=', $id)
                ->select('berita_acara_skripsi.*', 'users.*', 'sidang_skripsi.*', 'bidang_ilmu.*', 'bimbingan_skripsi.*', 'bimbingan_proposal.*', 'penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'penguji3.name as nama_penguji_3')
                ->first(),
        ];

        $bad = [
            'bad' => DB::table('detail_berita_acara_skripsi')
                    ->join('users', 'users.id', 'detail_berita_acara_skripsi.users_id')
                    ->where('berita_acara_skripsi_id', $id)
                    ->get(),
        ];


        return view('koordinator/berita_acara/sidang.detail', $data, $bad);

    }

}
