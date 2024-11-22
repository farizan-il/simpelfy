<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\PesanPengaduan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil pengaduan dengan pesan terkait, dan urutkan pesan dari yang paling lama ke paling baru
        $pengaduan = Pengaduan::with(['pesanPengaduan' => function ($query) {
            $query->orderBy('sent_at', 'asc');
        }])->where('user_credentials_id', auth()->id())->get();

        return view('gondowangi.frontend.pengaduan.index', [
            'title' => 'Pengaduan - Gondowangi',
            'pengaduan' => $pengaduan
        ]);
    }

    public function getMessages($id)
    {
        $pengaduan = Pengaduan::with(['pesanPengaduan' => function ($query) {
            $query->orderBy('sent_at', 'asc');
        }])->findOrFail($id);

        return response()->json($pengaduan->pesanPengaduan);
    }

    // Misalnya dalam fungsi loadMessages di Controller (sesuaikan sesuai nama fungsi)
    public function loadMessages($id)
    {
        $messages = PesanPengaduan::where('pengaduan_id', $id)
            ->orderBy('sent_at', 'asc') // Mengurutkan dari yang paling lama ke paling baru
            ->get();

        return response()->json($messages);
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
        // Validasi data
        $request->validate([
            'proofImage' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'complaintTitle' => 'required|string|max:255',
            'complaintMessage' => 'required|string',
        ]);

        // Simpan gambar
        if ($request->hasFile('proofImage')) {
            $image = $request->file('proofImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Simpan gambar ke folder public/files/buktipengaduan
            $image->move(public_path('files/buktipengaduan'), $filename);
        
            // Path file untuk disimpan di database
            $imagePath = 'files/buktipengaduan/' . $filename;
        }

        // Simpan pengaduan
        $pengaduan = Pengaduan::create([
            'user_credentials_id' => auth()->id(),
            'title' => $request->complaintTitle,
            'status' => 'in_progress'
        ]);

        // Simpan pesan pengaduan
        PesanPengaduan::create([
            'pengaduan_id' => $pengaduan->id,
            'user_credentials_id' => auth()->id(),
            'sender_type' => 'user',
            'message' => $request->complaintMessage,
            'file' => $imagePath,
            'sent_at' => now()
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function sendMessage(Request $request, $id)
    {   
        $validatedData = $request->validate([
            'message' => 'required|string',
        ]);

        $message = new PesanPengaduan([
            'pengaduan_id' => $id,
            'user_credentials_id' => auth()->id(),
            'sender_type' => 'user',
            'message' => $validatedData['message'],
            'sent_at' => now(),
        ]);

        $message->save();

        return response()->json($message);
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


