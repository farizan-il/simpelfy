<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqKategori;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = FaqKategori::all();
        $dataFaq = Faq::all();
        return view('gondowangi.backend.kelolaFAQ.index', [
            'title' => 'Kelola FAQ',
            'faq' => $dataFaq,
            'faqKategori' => $kategori
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
        try {
            $validated = $request->validate([
                'kategori_id' => 'required|exists:faqkategori,id',
                'pertanyaan' => 'required|string|max:255',
                'jawaban' => 'required|string',
            ]);
    
            $validated['nilai'] = 0;

            Faq::create($validated);
    
            return redirect()->route('kelolafaq.index')->with('success', 'FAQ berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();
    
            return redirect()->route('kelolafaq.index')
                ->with('success', 'FAQ berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('kelolafaq.index')
                ->with('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }
}
