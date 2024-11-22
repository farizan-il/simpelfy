<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelas;
use App\Models\Kelas;
use App\Models\Orders;
use App\Models\UserKomentar;
use Illuminate\Http\Request;

class DiscoveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve all categories with the count of classes
        $filterByCategori = KategoriKelas::withCount('kelas')->get();

        // Search and filter logic
        $query = Kelas::query();
        $query->where('status', 'publish');

        // Search by class name
        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->whereIn('namaKategori', $request->category);
            });
        }

        if ($request->has('sort') && $request->sort == 'populer') {
            $query->addSelect(['total_orders' => Orders::selectRaw('COUNT(*)')
                ->whereColumn('orders.kelas_id', 'kelas.id')
                ->groupBy('orders.kelas_id')
            ])->orderByDesc('total_orders');
        }

        // Paginate with 6 items per page
        $dataKelas = $query->paginate(12);
        foreach ($dataKelas as $kelas) {
            $kelas->totalRating = number_format(UserKomentar::where('kelas_id', $kelas->id)->avg('rating'), 2);
            $kelas->totalReviews = UserKomentar::where('kelas_id', $kelas->id)->count();
        }
        return view('gondowangi.frontend.discovery.index', [
            'title' => 'Discovery - LMS Gondowangi',
            'dataKelas' => $dataKelas,
            'filterCategory' => $filterByCategori
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
