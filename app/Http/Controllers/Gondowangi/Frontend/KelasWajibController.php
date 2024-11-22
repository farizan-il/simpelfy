<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KelasWajib;
use App\Models\Orders;
use App\Models\UserKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasWajibController extends Controller
{
    public function index(Request $request)
    {
        $userDepartementId = Auth::user()->profile->departement_id;
        $userGolonganId = Auth::user()->profile->golongan_id;
        $userId = Auth::id(); // ID pengguna yang sedang login

        // Query untuk KelasWajib dengan filter dan relasi, serta cek kelas yang sudah dibeli
        $query = KelasWajib::where('departement_id', $userDepartementId)
                    ->where('golongan_id', $userGolonganId)
                    ->whereDoesntHave('kelas.orders', function ($q) use ($userId) {
                        $q->where('user_credentials_id', $userId);
                    })
                    ->with(['kelas', 'kelas.kategori']);

        // Filter berdasarkan nama kelas
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('kelas', function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('kelas.kategori', function ($q) use ($request) {
                $q->whereIn('namaKategori', $request->category);
            });
        }

        // Sortir berdasarkan popularitas
        if ($request->has('sort') && $request->sort == 'populer') {
            $query->addSelect(['total_orders' => Orders::selectRaw('COUNT(*)')
                ->whereColumn('orders.kelas_id', 'kelas.id')
                ->groupBy('orders.kelas_id')
            ])->orderByDesc('total_orders');
        }

        // Paginate dengan 8 item per halaman
        $dataKelasWajib = $query->paginate(8);
        foreach ($dataKelasWajib as $kelas) {
            $kelas->totalRating = number_format(UserKomentar::where('kelas_id', $kelas->id)->avg('rating'), 2);
            $kelas->totalReviews = UserKomentar::where('kelas_id', $kelas->id)->count();
        }

        return view('gondowangi.frontend.discovery.kelaswajib.index', [
            'title' => 'Kelas Wajib - Gondowangi',
            'kelasWajib' => $dataKelasWajib
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

