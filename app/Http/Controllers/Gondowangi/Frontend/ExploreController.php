<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Faq;
use App\Models\KategoriKelas;
use App\Models\Kelas;
use App\Models\Keranjang;
use App\Models\Orders;
use App\Models\UserKomentar;
use App\Models\UserPreference;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $filterByCategori = KategoriKelas::withCount('kelas')->get();
        $query = Kelas::query()->where('status', 'publish');

        $purchasedClassIds = Orders::where('user_credentials_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $cartClassIds = Keranjang::where('user_credentials_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $query->whereNotIn('id', array_merge($purchasedClassIds, $cartClassIds));

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

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

        $perPage = $request->get('perPage', 12); // Default 16 kelas di load pertama
        $dataKelas = $query->paginate($perPage);

        if ($request->ajax()) {
            return view('gondowangi.frontend.explore.partials._kelas', compact('dataKelas'))->render();
        }

        // Calculate rating and review count for each class
        foreach ($dataKelas as $kelas) {
            $kelas->totalRating = number_format(UserKomentar::where('kelas_id', $kelas->id)->avg('rating'), 2);
            $kelas->totalReviews = UserKomentar::where('kelas_id', $kelas->id)->count();
        }

        $webinars = Webinar::all()->map(function ($webinar) {
            $webinar->formattedTanggalMulai = Carbon::parse($webinar->tanggalMulai)->translatedFormat('d F Y');
            $webinar->formattedJamMulai = Carbon::parse($webinar->jamMulai)->format('H:i');
            // Gabungkan tanggal dan waktu dalam format yang tepat
            $webinar->dateTimeStart = Carbon::parse($webinar->tanggalMulai)
                ->setTimeFromTimeString($webinar->jamMulai)
                ->format('Y-m-d H:i:s');
            return $webinar;
        });

        $pertanyaanpopuler = Faq::with('faqkategori')
            ->orderBy('nilai', 'desc')
            ->limit(5)
            ->get();

        // [------- awal logika untuk kelas relevan
        $preferredCategories = UserPreference::where('user_credentials_id', Auth::id())
            ->pluck('kategori_id')
            ->toArray();

        $kelasInKeranjang = Keranjang::where('user_credentials_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $kelasInOrders = Orders::where('user_credentials_id', Auth::id())
            ->pluck('kelas_id')
            ->toArray();

        $excludedKelasIds = array_merge($kelasInKeranjang, $kelasInOrders);
        
        // Ambil kelas yang sesuai dengan kategori preferensi
        $dataKelasRelevan = Kelas::whereIn('id_kategori', $preferredCategories)
            ->where('status', 'publish')
            ->whereNotIn('id', $excludedKelasIds)
            ->get();

        // [------- akhir logika untuk kelas relevan

        $dataArtikel = Artikel::all();
        return view('gondowangi.frontend.explore.index', [
            'title' => 'Explore',
            'dataKelas' => $dataKelas,
            'kelasRelevan' => $dataKelasRelevan,
            'filterCategory' => $filterByCategori,
            'webinar' => $webinars,
            'faq' => $pertanyaanpopuler,
            'artikel' => $dataArtikel
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
