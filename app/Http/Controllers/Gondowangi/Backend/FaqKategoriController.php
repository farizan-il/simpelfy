<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\FaqKategori;
use Illuminate\Http\Request;

class FaqKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataFaq = FaqKategori::all();
        return view('gondowangi.backend.kelolaFAQ.KategoriFaq.index', [
            'title' => 'Kelola FAQ',
            'faqKategori' => $dataFaq
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
            'namaKategori' => 'required|string',
        ]);

        FaqKategori::create([
            'namaKategori' => $request->namaKategori
        ]);

        return redirect()->route('kategorifaq.index')->with('success', 'Kategori FAQ berhasil ditambahkan');
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
