<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogBerita;
use Illuminate\Http\Request;

class BlogBeritaController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogberita = BlogBerita::all();
        return view('gondowangi.backend.komponenweb.blog.index', [
            'title' => 'Kelola Blog dan Berita',
            'data' => $blogberita
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
        // Validasi data input
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

 
        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');
            $path = $file->store('komponenweb/sampulblog', 'public');
        }

        // Menyimpan data ke database
        BlogBerita::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'sampul' => $path ?? null // jika ada gambar, simpan path-nya
        ]);

        // Redirect setelah data disimpan
        return redirect()->route('blog.index')->with('success', 'Item berhasil ditambahkan');
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
        $blog = BlogBerita::findOrFail($id);
        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog berhasil dihapus');
    }
}
