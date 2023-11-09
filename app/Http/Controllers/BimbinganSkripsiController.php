<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailBimbinganSkripsi as DetailBimbinganSkripsi;


class BimbinganSkripsiController extends Controller
{
    //
    public function index()
    {
        $dosens = DB::table('bimbingan_skripsi')
        ->join('bimbingan_proposal', 'bimbingan_proposal.id_bimbingan_proposal', 'bimbingan_skripsi.bimbingan_proposal_id')
        ->where('user_id', '=', Auth::user()->id)->first();
        // return view('mahasiswa/proposal/bimbingan.index', compact('dosens'));
        return view('mahasiswa/skripsi/bimbingan.index', compact('dosens'));


    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file_skripsi' => 'required|mimes:pdf,docx|max:1000',
            'file_skripsi.required' => 'File Skripsi wajib diunggah.',
            'file_skripsi.mimes' => 'Tipe file harus pdf atau docx.',
            'file_skripsi.max' => 'Ukuran file melebihi batas maksimum (1000 KB).',
        ]);

        if ($request->hasFile('file_skripsi')) {
            $proposalFilePath = $request->file('file_skripsi');
            $fileName = uniqid() . '.' . $proposalFilePath->getClientOriginalExtension();
            $userFolder = Auth::user()->name;
            $proposalFilePath->move(public_path('uploads/'.$userFolder.'/bimbingan_skripsi/'), $fileName);
            $fileUrl = 'uploads/'.$userFolder.'/bimbingan_skripsi/'.$fileName;
        } else {
            return response()->json(['success' => false, 'message' => 'File skripsi tidak valid.']);
        }

        $bimbingan = new DetailBimbinganSkripsi();
        $bimbingan->bimbingan_skripsi_id = $request->input('bimbingan_skripsi_id'); // Sesuaikan ini dengan input yang benar
        $bimbingan->file = $fileUrl;
        $bimbingan->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'File berhasil diunggah.']);
    }
}