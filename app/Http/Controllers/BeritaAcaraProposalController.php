<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaAcaraProposal as BeritaAcaraProposal;
use App\Models\DetailBeritaAcaraProposal as DetailBeritaAcaraProposal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BeritaAcaraProposalController extends Controller
{
    //
    public function index()
    {
     
        $ba = DB::table('berita_acara_proposal')
        ->join('users', 'users.id', 'berita_acara_proposal.users_id')
        ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
        ->where(function($query) {
            $query->where('seminar_proposal.dosen_penguji_1', '=', Auth::user()->id)
                  ->orWhere('seminar_proposal.dosen_penguji_2', '=', Auth::user()->id);
        })
        ->get();
    
        return view('dosen/berita_acara/seminar.index', compact('ba'));
    
    }
    public function detail($id)
    {
        $data = [
            'data' => DB::table('berita_acara_proposal')
               
                ->join('users', 'users.id', 'berita_acara_proposal.users_id')
                ->join('seminar_proposal', 'seminar_proposal.id_seminar_proposal', 'berita_acara_proposal.seminar_proposal_id')
                ->join('users as penguji1', 'penguji1.id', 'seminar_proposal.dosen_penguji_1')
                ->join('users as penguji2', 'penguji2.id', 'seminar_proposal.dosen_penguji_2')
                ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'seminar_proposal.bimbingan_proposal_id')
                ->join('bidang_ilmu', 'bidang_ilmu.id_bidang_ilmu', 'bimbingan_proposal.bidang_ilmu_id')
                ->where('id_berita_acara_p', '=', $id)
                ->select('berita_acara_proposal.*', 'users.*', 'seminar_proposal.*', 'bidang_ilmu.*', 'bimbingan_proposal.*','penguji1.name as nama_penguji_1', 'penguji2.name as nama_penguji_2')
                ->first(),
        ];
       
    
        // return view('dosen/berita_acara/seminar.detail', $data);
        return view('dosen/berita_acara/seminar.detail', $data);

    }

    public function store(Request $request)
    {
        $dba = new DetailBeritaAcaraProposal();

        $dba->users_id = Auth::user()->id;
        $dba->berita_acara_proposal_id = $request['ba_id'];
        $dba->presensi = 'hadir';
        $dba->revisi = $request['revisi'];
        $dba->nilai = $request['nilai'];

        $dba->save();
        return redirect()->back()->with('success', 'Data updated successfully.');
    }
}
