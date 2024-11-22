<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $pengaduanAntrian = Pengaduan::with('pesanPengaduan.credentials')
            ->where('status', 'in_progress')
            ->get();

        $pengaduanSelesai = Pengaduan::with('pesanPengaduan.credentials')
            ->where('status', 'closed')
            ->get();

        return view('gondowangi.backend.pengaduan.index', [
            'title' => 'Aktivitas Karyawan - Gondowangi',
            'pengaduanAntrian' => $pengaduanAntrian,
            'pengaduanSelesai' => $pengaduanSelesai,
        ]);
    }

    public function showDetail($id)
    {
        $pengaduan = Pengaduan::with(['pesanPengaduan.credentials'])->find($id);

        // Pastikan pengaduan ditemukan
        if (!$pengaduan) {
            return response()->json(['message' => 'Pengaduan tidak ditemukan'], 404);
        }

        $messages = $pengaduan->pesanPengaduan->map(function ($message) {
            return [
                'text' => $message->message,
                'sender' => $message->sender_type,
            ];
        });

        return response()->json([
            'user' => [
                'name' => $pengaduan->credentials->profile->nama ?? 'Unknown User',
                'role' => $pengaduan->credentials->profile->departement->departement ?? 'User',
            ],
            'messages' => $messages,
        ]);
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
        //
    }
}
