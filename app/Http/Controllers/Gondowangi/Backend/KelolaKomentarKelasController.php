<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserKomentar;
use Illuminate\Http\Request;

class KelolaKomentarKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datakomentar = UserKomentar::orderBy('created_at', 'desc')->paginate(10);

        return view('gondowangi.backend.kelolakomentar.komentarkelas.index', [
            'title' => 'Komentar Kelas - Gondowangi',
            'komentar' => $datakomentar
        ]);
    }


    public function updateStatus(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'status' => 'required|in:Draf,Disetujui',
        ]);

        // Cari komentar berdasarkan ID
        $komentar = UserKomentar::findOrFail($id);

        // Ubah status komentar
        $komentar->status = $request->status;
        $komentar->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status komentar berhasil diubah.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
