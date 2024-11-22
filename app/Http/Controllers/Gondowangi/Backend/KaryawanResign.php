<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class KaryawanResign extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKaryawan = UserProfile::whereHas('role', function($query) {
            $query->where('roleName', 'enduser');
        })->get();

        return view('gondowangi.backend.karyawanresign.index', [
            'title' => 'Kelola Karyawan',
            'karyawan' => $dataKaryawan
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
        //
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
