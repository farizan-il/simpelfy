<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Golongan;
use App\Models\KelolaKoin;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class KelolaKoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $datadepartements = Departement::orderBy('departement', 'asc')->get();
        $datagolongan = Golongan::all();

        $koin = KelolaKoin::select('departement_id', 'golongan_id', 'gonpay')
            ->with(['departement', 'golongan'])
            ->groupBy('departement_id', 'golongan_id', 'gonpay')
            ->get();

        // Ambil id yang ada di tabel kelolakoin
        // $departementIdsInKoin = KelolaKoin::pluck('departement_id')->toArray();
        // $gelombangIdsInKoin = KelolaKoin::pluck('golongan_id')->toArray();

        // Filter yang tidak ada di kelolakoin
        // $filteredDepartements = $datadepartements->whereNotIn('id', $departementIdsInKoin);
        // $filteredGelombang = $datagolongan->whereNotIn('id', $gelombangIdsInKoin);

        return view('gondowangi.backend.kelolakoin.index', [
            'title' => 'Kelas Saya - Gondowangi',
            'koin' => $koin,
            'departements' => $datadepartements,
            'golongan' => $datagolongan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function kirimKoin(Request $request)
    {
        $request->validate([
            'departement_id' => 'required|exists:departement,id',
            'golongan_id' => 'required|exists:golongan,id',
            'gonpay' => 'required|numeric|min:0'
        ]);
    
        $usersInDepartementAndGolongan = UserProfile::where('departement_id', $request->departement_id)
            ->where('golongan_id', $request->golongan_id)
            ->get();
    
        if ($usersInDepartementAndGolongan->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pengguna ditemukan untuk departemen dan golongan yang dipilih'
            ]);
        }
    
        foreach ($usersInDepartementAndGolongan as $userProfile) {
            $userCredentials = $userProfile->credentials;
    
            $userCredentials->gonpay += $request->gonpay;
            $userCredentials->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Koin berhasil dikirim ke departemen dan golongan'
        ]);
    }
     

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'departement' => 'required|exists:departement,id', 
            'golongan' => 'required|exists:golongan,id',
            'gonpay' => 'required|numeric',
        ]);

        // Cek apakah kombinasi departement_id dan golongan_id sudah ada
        $existingData = KelolaKoin::where('departement_id', $request->departement)
                        ->where('golongan_id', $request->golongan)
                        ->first();

        if ($existingData) {
            return redirect()->back()->withErrors(['error' => 'Kombinasi departement dan golongan sudah ada dalam database.']);
        }

        // Simpan data ke tabel KelolaKoin
        KelolaKoin::create([
            'departement_id' => $request->departement,
            'golongan_id' => $request->golongan,
            'gonpay' => $request->gonpay,
        ]);

        // Redirect ke halaman kelola karyawan dengan pesan sukses
        return redirect('/kelolakoin')->with('success', 'Data berhasil ditambahkan.');
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
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'gonpay' => 'required|numeric',
        ]);

        // Cari koin berdasarkan departement_id dan update data
        $kelolaKoin = KelolaKoin::where('departement_id', $id)->first();
        $kelolaKoin->gonpay = $request->input('gonpay');
        $kelolaKoin->save();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('kelolakoin.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
