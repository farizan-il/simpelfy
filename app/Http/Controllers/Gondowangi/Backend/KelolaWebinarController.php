<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserHasWebinar;
use App\Models\Webinar;
use Illuminate\Http\Request;

class KelolaWebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $webinars = Webinar::all();
        return view('gondowangi.backend.kelolawebinar.index', [
            'webinars' => $webinars,
            'title' => 'Kelola Webinar'
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
        $request->validate([
            'foto' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'tanggalMulai' => 'required|string',
            'jamMulai' => 'required|string',
        ]);

        Webinar::create([
            'foto' => $request->foto,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'tanggalMulai' => $request->tanggalMulai,
            'jamMulai' => $request->jamMulai,
        ]);

        return redirect()->route('kelolawebinar.index')->with('success', 'Webinar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $webinar = Webinar::findOrFail($id);

        // Ambil data karyawan yang mendaftar di webinar tersebut
        $pendaftarWebinar = UserHasWebinar::with('credentials.profile')
            ->where('user_has_webinar_id', $id)
            ->get();

        return view('gondowangi.backend.kelolawebinar.show', [
            'webinar' => $webinar,
            'pendaftarWebinar' => $pendaftarWebinar,
            'title' => 'Detail Webinar'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $webinar = Webinar::findOrFail($id);
        return view('webinar.edit', compact('webinar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'tanggalMulai' => 'required|string',
            'jamMulai' => 'required|string',
        ]);

        $webinar = Webinar::findOrFail($id);
        $webinar->update([
            'foto' => $request->foto,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'tanggalMulai' => $request->tanggalMulai,
            'jamMulai' => $request->jamMulai,
        ]);

        return redirect()->route('webinars.index')->with('success', 'Webinar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $webinar = Webinar::findOrFail($id);
        $webinar->delete();

        return redirect()->route('kelolawebinar.index')->with('success', 'Webinar berhasil dihapus');
    }
}
