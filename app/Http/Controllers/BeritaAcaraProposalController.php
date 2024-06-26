<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;
use App\Models\DetailBeritaAcaraProposal as DetailBeritaAcaraProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class BeritaAcaraProposalController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDosen');
    }
    public function index()
    {
        try {
            $ba = DB::table('berita_acara_proposal')
                ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
                ->leftjoin('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                ->leftjoin('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
                ->where(function ($query) {
                    $query->where('seminar_proposal.dosen_penguji_1', '=', Auth::user()->id)
                        ->orWhere('seminar_proposal.dosen_penguji_2', '=', Auth::user()->id)
                        ->orWhere('bimbingan_proposal.dosen_pembimbing_utama', '=', Auth::user()->name);
                })
                ->latest('berita_acara_proposal.created_at')
                ->get();
            $angkatan = DB::table('angkatan')->get();

            return view('dosen/berita_acara/seminar.index', compact('ba', 'angkatan'));
        } catch (QueryException $e) {
            // Handle the query exception
            // Log the error, redirect to an error page, or display a custom error message
            return redirect()->route('404')->with('error', 'An error occurred while fetching data.');
        }
    }
    public function detail($id)
    {
        try {
            $data = [
                'data' => DB::table('berita_acara_proposal')
                    ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                    ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
                    ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
                    ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
                    ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                    ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                    ->join('pengajuan_judul', 'pengajuan_judul.id_pengajuan_judul', 'bimbingan_proposal.pengajuan_id')
                    ->join('ruangan', 'ruangan.id_ruangan', 'seminar_proposal.ruangan')
                    ->where('id_berita_acara_p', $id)
                    ->select('berita_acara_proposal.*', 'users.*', 'seminar_proposal.*', 'bidang_ilmu.*', 'bimbingan_proposal.*', 'ruangan.nama_ruangan','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2', 'pengajuan_judul.judul')
                    ->first(),

            ];
            $detail = [
                'detail' => DB::table('detail_berita_acara_proposal')->where('berita_acara_proposal_id', $id)->where('users_id', Auth::user()->id)->first(),
            ];
            return view('dosen/berita_acara/seminar.detail', $data, $detail);
        } catch (QueryException $e) {
            // Handle the query exception
            // Log the error, redirect to an error page, or display a custom error message
            return redirect()->route('404')->with('error', 'An error occurred while fetching data.');
        }
    }

    public function showReviewForm($id)
    {
        // Similar to your existing code to fetch data
        $proposal = DB::table('berita_acara_proposal')->where('id_berita_acara_p', $id)->where('users_id', Auth::user()->id)->first();
        return view('dosen/berita_acara/seminar.review_form', compact('proposal'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'berita_acara_proposal_id' => 'required|integer',
            'revisi' => 'required|string',
            'nilai' => 'required|numeric',
        ], [
            'required' => 'Field :attribute harus diisi.',
            'integer' => 'Field :attribute harus berupa angka.',
            'string' => 'Field :attribute harus berupa teks.',
            'numeric' => 'Field :attribute harus berupa angka.',
        ]);
        try {
            $detailBAP = new DetailBeritaAcaraProposal();
            $detailBAP->users_id = Auth::user()->id;
            $detailBAP->berita_acara_proposal_id = $request->berita_acara_proposal_id;
            $detailBAP->presensi = 'hadir';
            $detailBAP->revisi = $request->revisi;
            $detailBAP->nilai = $request->nilai;
            $detailBAP->save();
            return redirect()->route('berita-acara-proposal.index')->with('success', 'Berita Acara Proposal berhasil diisi.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Pesan Kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}