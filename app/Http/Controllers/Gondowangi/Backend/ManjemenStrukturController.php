<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Departement;
use App\Models\Golongan;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class ManjemenStrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        $golongans = Golongan::all();
        $departements = Departement::all();
        $areas = Area::all();

        return view('gondowangi.backend.manajemenstruktur.index', [
            'title' => 'Kategori Kelas - Gondowangi',
            'jabatans' => $jabatans,
            'golongans' => $golongans,
            'departements' => $departements,
            'areas' => $areas
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
        // Check the form type to determine which model to use
        if ($request->type == 'jabatan') {
            Jabatan::create([
                'jabatan' => $request->input1
            ]);
        } elseif ($request->type == 'golongan') {
            Golongan::create([
                'golongan' => $request->input1
            ]);
        } elseif ($request->type == 'departement') {
            Departement::create([
                'departement' => $request->input1
            ]);
        } elseif ($request->type == 'area') {
            Area::create([
                'area' => $request->input1
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
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
