<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelas;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class KategoriKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datakategori = KategoriKelas::with('subkategori')->get(); // Memuat subkategori terkait
        return view('gondowangi.backend.kelas.kategorikelas.index', [
            'title' => 'Kategori Kelas - Gondowangi',
            'kategori' => $datakategori
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
        $ValidatedData = $request->validate([
            'kategori' => 'required|max:255',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            Image::make($image)->save(public_path('image/icon-kategori/' . $filename));
            $validatedData['icon'] = $filename;
        }

        $addKategori = KategoriKelas::create([
            'namaKategori' =>$ValidatedData['kategori'],
            'image' => $validatedData['icon']
        ]);

        if ($addKategori) {
            return redirect('/kategorikelas')->with('success', 'Kategori Kelas Berhasil Ditambahkan!');
        }else{
            return redirect('/kategorikelas')->with('error', 'Kategori Kelas gagal Ditambahkan!');
        }
    }

    public function storeSubkategori(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategori,id', // Validasi kategori ID
            'subkategori' => 'required|max:255',
        ]);

        $addSubKategori = SubKategori::create([
            'id_kategori' => $validatedData['id_kategori'],
            'namaSubkategori' => $validatedData['subkategori'],
        ]);

        if ($addSubKategori) {
            return redirect('/kategorikelas')->with('success', 'Subkategori Berhasil Ditambahkan!');
        } else {
            return redirect('/kategorikelas')->with('error', 'Subkategori gagal Ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
        $kategori = KategoriKelas::findOrFail($id);

        if ($kategori->kelas()->count() > 0) {
            return response()->json(['error' => 'Masih ada kelas yang terikat dengan kategori ini!'], 400);
        }

        $kategori->delete();

        return response()->json(['success' => 'Kategori Kelas berhasil dihapus.'], 200); 
    }

}
