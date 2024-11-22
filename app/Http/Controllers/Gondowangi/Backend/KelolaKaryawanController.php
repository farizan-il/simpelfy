<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserCredentials;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Departement;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\UserHasSkor;

class KelolaKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data karyawan yang role-nya adalah 'karyawan'
        $dataKaryawan = UserProfile::whereHas('role', function($query) {
            $query->where('roleName', 'enduser');
        })->get();

        return view('gondowangi.backend.kelolakaryawan.index', [
            'title' => 'Kelola Karyawan - Gondowangi',
            'karyawan' => $dataKaryawan,
            
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        $departements = Departement::all();
        $areas = Area::all();
        return view('gondowangi.backend.kelolakaryawan.create', [
            'title' => 'Menambahkan Karyawan - Gondowangi',
            'jabatans' => $jabatans,
            'golongans' => $golongans,
            'departements' => $departements,
            'areas' => $areas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usercredentials,email',
            'jeniskelamin' => 'required|in:Pria,Wanita',
            'katasandi' => 'required',
            'jabatan' => 'required',
            'golongan' => 'required',
            'departement' => 'required|exists:departement,id', 
            'tglmasuk' => 'required|date',
            'area' => 'required',
            'status' => 'required',
            'gonpay' => 'required|numeric',
        ]);

        $userCredentials = UserCredentials::create([
            'email' => $request->email,
            'gonpay' => $request->gonpay,
            'password' => bcrypt($request->katasandi),
        ]); 

        UserHasSkor::create([
            'user_credentials_id' => $userCredentials->id
        ]);

        UserProfile::create([
            'user_credentials_id' => $userCredentials->id,
            'role_id' => '48f2740e-7f3a-11ef-abce-334bdb6c896b',
            'nik' => $request->nik,
            'nama' => $request->nama,
            'jenisKelamin' => $request->jeniskelamin,
            'jabatan' => $request->jabatan,
            'golongan_id' => $request->golongan,
            'departement_id' => $request->departement,
            'tanggalMasuk' => $request->tglmasuk,
            'area' => $request->area,
            'status' => $request->status,
            'fotoProfile' => 'default-profile.jpg',
        ]);

        // Redirect ke halaman kelola karyawan dengan pesan sukses
        return redirect('/kelolakaryawan')->with('success', 'Karyawan berhasil ditambahkan.');
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
        
    }

    public function updateStatus($id)
    {
        $karyawan = UserProfile::findOrFail($id);

        $karyawan->credentials->update([
            'isActive' => 0,
            'gonpay' => 0
        ]);

        return redirect()->route('kelolakaryawan.index')->with('success', 'Karyawan berhasil dinonaktifkan.');
    }

    public function updateKoin(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'gonpay' => 'required|numeric|min:0'
        ]);

        // Cari user credentials berdasarkan ID
        $userCredentials = UserCredentials::findOrFail($id);

        // Tambahkan jumlah koin yang diinputkan ke 'gonpay' yang ada
        $userCredentials->gonpay += $request->gonpay;

        // Simpan perubahan
        $userCredentials->save();

        return redirect()->back()->with('success', 'Koin Gonpay berhasil ditambahkan!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
