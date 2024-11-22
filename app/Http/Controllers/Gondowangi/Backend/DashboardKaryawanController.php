<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use App\Models\Orders;
use App\Models\UserActivity;
use App\Models\UserHasSkor;
use App\Models\UserHasSpentTime;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->format('Y-m');
    
        // [--------------- logika untuk ditampilkan di card -------------------]
        // Menghitung total kelas keseluruhan yang dibeli
        $totalKelasKeseluruhan = Orders::where('user_credentials_id', $userId)->count();

        // Menghitung total kelas yang dibeli di bulan ini
        $totalKelasBulanIni = Orders::where('user_credentials_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Total pengeluaran semua transaksi pengguna yang sedang login
        $totalPengeluaran = Orders::where('user_credentials_id', $userId)->sum('harga');
    
        // Menghitung total pengeluaran bulan ini
        $pengeluaranBulanIni = Orders::where('user_credentials_id', $userId)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('harga');
    
        // Menghitung total pengeluaran bulan lalu
        $pengeluaranBulanLalu = Orders::where('user_credentials_id', $userId)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->sum('harga');
    
        // Persentase perubahan dibandingkan bulan lalu
        $perubahan = $pengeluaranBulanLalu > 0 ? (($pengeluaranBulanIni - $pengeluaranBulanLalu) / $pengeluaranBulanLalu) * 100 : 0;

        $kelasSelesai = Orders::where('user_credentials_id', $userId)
        ->whereHas('userprogress', function ($query) {
            $query->where('status', 'selesai');
        })
        ->whereDoesntHave('userprogress', function ($query) {
            $query->where('status', 'proses');
        })
        ->count();

        // Data untuk kategori "Kelas Dalam Proses"
        $kelasDalamProses = Orders::where('user_credentials_id', $userId)
            ->whereHas('userprogress', function ($query) {
                $query->where('status', 'proses');
            })
            ->where('masaAktif', '>', Carbon::now())
            ->count();

        // Data untuk kategori "Kelas Tidak Tuntas"
        $kelasTidakTuntas = Orders::where('user_credentials_id', $userId)
            ->whereHas('userprogress', function ($query) {
                $query->where('status', 'proses');
            })
            ->where('masaAktif', '<', Carbon::now())
            ->count();

            $totalKelasBulanIni = Orders::where('user_credentials_id', $userId)
            ->where('tanggalPembelian', 'like', "$currentMonth%")
            ->count();
    
        // Total kelas dalam proses bulan ini
        $kelasProsesBulanIni = Orders::where('user_credentials_id', $userId)
            ->whereHas('userprogress', function($query) {
                $query->where('status', 'proses');
            })
            ->where('tanggalPembelian', 'like', "$currentMonth%")
            ->count();
    
        // Total kelas tidak tuntas bulan ini (masa aktif expired)
        $kelasTidakTuntasBulanIni = Orders::where('user_credentials_id', $userId)
            ->whereHas('userprogress', function($query) {
                $query->where('status', 'proses');
            })
            ->whereDate('masaAktif', '<', now())
            ->where('tanggalPembelian', 'like', "$currentMonth%")
            ->count();
        // [--------------- akhir logika untuk ditampilkan di card -------------------]


        // [--------------- logika untuk ditampilkan di grafik -------------------]

        // awal logika grafik riwayat transaksi
        $pengeluaranPerBulan = Orders::selectRaw('MONTH(created_at) as bulan, SUM(harga) as total')
            ->where('user_credentials_id', $userId)
            ->whereYear('created_at', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $bulan = [];
        $dataTransaksi = [];
        for ($i = 1; $i <= 12; $i++) {
            $namaBulan = Carbon::create()->month($i)->format('M'); 
            $bulan[] = $namaBulan;
            $dataTransaksi[] = $pengeluaranPerBulan[$i] ?? 0;
        }
        // akhir logika grafik riwayat transaksi

        // awal logika riwayat aktivitas karyawan
        $userActivities = UserActivity::where('user_credentials_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5) // Batas jumlah aktivitas yang ditampilkan, misalnya 10
            ->get();
        // akhir logika riwayat aktivitas karyawan


        // [----- awal logika penghitungan score karyawan
        $allScores = UserHasSkor::orderBy('skor', 'desc')->get();

        // Hitung total bintang yang beredar
        $totalScore = $allScores->sum('skor');
    
        // Ambil data skor pengguna tertentu, misalnya ID 5 (ganti sesuai ID pengguna saat ini)
        $userScore = UserHasSkor::where('user_credentials_id', Auth::user()->id)->first();
    
        // Hitung persentase skor pengguna tersebut
        $percentage = 0;
        if ($totalScore > 0 && $userScore) {
            $percentage = ($userScore->skor / $totalScore) * 100;
        }
    
        // Cari peringkat pengguna berdasarkan urutan skor
        $ranking = $allScores->search(function ($item) use ($userScore) {
            return $item->user_credentials_id == $userScore->user_credentials_id;
        }) + 1;
        // [-----  akhir logika penghitugan score karyawan

        // [--------------- akhir logika untuk ditampilkan di grafik -------------------]
    

        // query untuk riwayat kelas yang idikuti $dataKelas = Orders::with('kelas', 'userprogress')->where('user_credentials_id', Auth::id())->get();
        $dataKelas = Orders::with('kelas', 'userprogress')->where('user_credentials_id', Auth::id())->get();
        // akhir query untuk riwayat kelas yang idikuti

        $kategoriData = Orders::where('user_credentials_id', $userId)
            ->with('kelas.kategori')
            ->get()
            ->groupBy('kelas.kategori.namaKategori')
            ->map(function ($orders) {
                return $orders->count();
        });

        $kategoriLabels = $kategoriData->keys();
        $kategoriCounts = $kategoriData->values();

        // LOGIKA UNTUK CHART WAKTU YANG DIHABISKAN
        $spentTimeData = UserHasSpentTime::whereHas('userProgress', function($query) {
            $query->where('user_credentials_id', Auth::id());
        })
        ->selectRaw("DATE_FORMAT(created_at, '%W') as hari, type, SUM(spentTime) as total_waktu")
        ->groupBy('hari', 'type')
        ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
        ->get()
        ->groupBy('type');

        $videoTimes = $spentTimeData->get('video', collect())->pluck('total_waktu')->toArray();
        $soalTimes = $spentTimeData->get('soal', collect())->pluck('total_waktu')->toArray();
        // LOGIKA UNTUK CHART WAKTU YANG DIHABISKAN

        // LOGIKA MENGAMBIL DATA KARYAWAN DAN DEPARTEMENT DARI DATABASE
        $dataKaryawan = UserProfile::with('role')
            ->where('role_id', '48f2740e-7f3a-11ef-abce-334bdb6c896b')
            ->get();
        $dataDepartemen = Departement::all();

        return view('gondowangi.backend.dashboard.dashboardkaryawan.index', [
            'title' => 'Beranda - Gondowangi',
            'pengeluaranBulanIni' => $pengeluaranBulanIni,
            'perubahan' => $perubahan,
            'totalPengeluaran' => $totalPengeluaran,
            'bulan' => $bulan,
            'dataTransaksi' => $dataTransaksi,
            'totalKelasKeseluruhan' => $totalKelasKeseluruhan,
            'totalKelasBulanIni' => $totalKelasBulanIni,
            'kelas' => $dataKelas,
            'kategoriLabels' => $kategoriLabels,
            'kategoriCounts' => $kategoriCounts,
            'kelasSelesai' => $kelasSelesai,
            'kelasDalamProses' => $kelasDalamProses,
            'kelasTidakTuntas' => $kelasTidakTuntas,
            'totalKelasBulanIni' => $totalKelasBulanIni,
            'kelasProsesBulanIni' => $kelasProsesBulanIni,
            'kelasTidakTuntasBulanIni' => $kelasTidakTuntasBulanIni,
            'userScore' => $userScore->skor,
            'percentage' => round($percentage, 2),
            'totalEmployees' => $allScores->count(),
            'ranking' => $ranking,
            'userActivities' => $userActivities,
            'videoTimes' => $videoTimes,
            'soalTimes' => $soalTimes,
            'dataKaryawan' => $dataKaryawan,
            'dataDepartemen' => $dataDepartemen
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
