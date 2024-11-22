<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\DetailModul;
use App\Models\Golongan;
use App\Models\KategoriKelas;
use App\Models\Kelas;
use App\Models\KelasWajib;
use App\Models\ModulKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); 
        $filter = $request->input('filter', 'semua');

        // Query untuk pencarian dan filter
        if ($filter === 'publish' ) {
            $dataTableKelas = Kelas::where('status', 'publish')->paginate(10);
        } elseif ($filter === 'draf') {
            $dataTableKelas = Kelas::where('status', 'draf')->paginate(10);
        } else {
            // Filter untuk 'semua'
            $dataTableKelas = Kelas::where('title', 'like', "%$search%")
                ->orWhereHas('kategori', function($query) use ($search) {
                    $query->where('namaKategori', 'like', "%$search%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        // Menghitung jumlah untuk setiap kategori
        $totalKelas = Kelas::count(); 
        $totalKelasPublish = Kelas::where('status', 'publish')->count(); 
        $totalKelasDraf = Kelas::where('status', 'draf')->count();

        $filterbydepartement = Departement::all();

        return view('gondowangi.backend.kelas.kelolakelas.index', [
            'title' => 'Kelola Kelas - Gondowangi',
            'dataKelas' => $dataTableKelas,
            'totalKelas' => $totalKelas,
            'totalKelasPublish' => $totalKelasPublish,
            'totalKelasDraf' => $totalKelasDraf,
            'filter' => $filter,
            'search' => $search,
            'departement' => $filterbydepartement
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        $golongan = Golongan::all();
        $kategori = KategoriKelas::all();
        return view('gondowangi.backend.kelas.kelolakelas.create', [
            'title' => 'Menambahkan Kelas - Gondowangi',
            'kategori' => $kategori,
            'departemen' => $departements,            
            'golongan' => $golongan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'judul' => 'required|max:255',
            'subtitle' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'keuntungan' => 'required',
            'syarat' => 'required',
            'instruktur' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('image/kelas-sampul/' . $filename));
            $ValidatedData['gambar'] = $filename;
        }

        // Simpan data kelas ke tabel kelas
        $addKegiatan = Kelas::create([
            'title' => $ValidatedData['judul'],
            'subtitle' => $ValidatedData['subtitle'],
            'id_kategori' => $ValidatedData['kategori'],
            'deskripsi' => $ValidatedData['deskripsi'],
            'foto' => $ValidatedData['gambar'],
            'keuntungan' => $ValidatedData['keuntungan'],
            'syarat' => $ValidatedData['syarat'],
            'instruktur' => $ValidatedData['instruktur']
        ]);

        // Ambil semua departemen dan golongan jika dibutuhkan
        $allDepartements = Departement::all();
        $allGolongans = Golongan::all();

        // Jika kelas wajib dipilih, simpan ke tabel kelaswajib
        if ($request->input('kelasWajib') == 'iya') {
            $departement_id = $request->input('departement');
            $golongan_id = $request->input('golongan');

            // Cek apakah opsi 'Pilih Semua' dipilih
            $departement_ids = ($departement_id === 'all') ? $allDepartements->pluck('id') : collect([$departement_id]);
            $golongan_ids = ($golongan_id === 'all') ? $allGolongans->pluck('id') : collect([$golongan_id]);

            foreach ($departement_ids as $dept) {
                foreach ($golongan_ids as $gol) {
                    KelasWajib::create([
                        'kelas_id' => $addKegiatan->id,
                        'departement_id' => $dept,
                        'golongan_id' => $gol
                    ]);
                }
            }
        }

        if ($addKegiatan) {
            return redirect('/kelolakelas')->with('success', 'Kelas Berhasil Ditambahkan!');
        } else {
            return redirect('/kelolakelas')->with('error', 'Kelas gagal Ditambahkan!');
        }
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
        $editKelas = Kelas::findOrFail($id);
        return view('gondowangi.backend.kelas.kelolakelas.edit', [
            'title' => 'Edit Kelas - Gondowangi',
            'dataKelas' => $editKelas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:draf,publish',
        ]);

        // Cari kelas berdasarkan ID
        $kelas = Kelas::findOrFail($id);

        // Update status kelas
        $kelas->status = $request->input('status');
        $kelas->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status kelas berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Cek apakah ada data terkait di tabel kelaswajib
        if ($kelas->kelasWajib()->exists()) {
            // Hapus kelas wajib yang terkait
            $kelas->kelasWajib()->delete();
        }

        // Hapus kelas
        $kelas->delete();

        return response()->json(['success' => 'Kelas dan kelas wajib berhasil dihapus.']);
    }
}