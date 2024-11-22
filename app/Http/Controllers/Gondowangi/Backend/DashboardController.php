<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\ModulKelas;
use App\Models\Orders;
use App\Models\UserActivity;
use App\Models\UserHasSkor;
use App\Models\UserHasSpentTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasterbaru = Kelas::latest()->take(3)->get();
        $totalkelas = Kelas::all()->count(); // Menghitung total kelas

        // Ambil jumlah modul untuk setiap kelas
        foreach ($kelasterbaru as $kelas) {
            $kelas->jumlahModul = ModulKelas::where('id_kelas', $kelas->id)->count();
        }

        $dataorder = Orders::with('kelas', 'credentials')->take(5)->get();
        $aktivitasUser = Orders::with('kelas', 'userprogress')->get();

        // Menghitung jumlah kelas dalam proses
        $kelasDalamProses = Orders::whereHas('userprogress', function ($query) {
            $query->where('status', 'proses');
        })->count();

        // Menghitung kelas yang semua progress-nya selesai
        $kelasSelesai = Orders::whereDoesntHave('userprogress', function ($query) {
            // Memastikan tidak ada progres yang statusnya bukan 'selesai'
            $query->where('status', '!=', 'selesai');
        })->count();

        $pengeluaranPerBulan = Orders::selectRaw('MONTH(created_at) as bulan, SUM(harga) as total')
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

        $spentTimeData = UserHasSpentTime::whereHas('userProgress')
            ->selectRaw("
                DATE_FORMAT(created_at, '%d %b') as tanggal, 
                DATE_FORMAT(created_at, '%W') as hari,
                type, 
                SUM(spentTime) as total_waktu
            ")
            ->groupBy('tanggal', 'hari', 'type')
            ->orderByRaw("DATE(created_at)")
            ->get()
            ->groupBy('type');

        // Mengelompokkan data video dan soal berdasarkan tanggal
        $videoData = $spentTimeData->get('video', collect())->pluck('total_waktu', 'tanggal')->toArray();
        $soalData = $spentTimeData->get('soal', collect())->pluck('total_waktu', 'tanggal')->toArray();

        // Membuat daftar tanggal berdasarkan data yang ada
        $dates = array_keys($videoData + $soalData); // Gabungkan kunci untuk mendapatkan semua tanggal

        // Menyusun data menjadi array sesuai tanggal
        $videoTimes = array_map(fn($date) => $videoData[$date] ?? 0, $dates);
        $soalTimes = array_map(fn($date) => $soalData[$date] ?? 0, $dates);

        // Aktivitas Admin
        $aktivitasAdmin = UserActivity::with('credentials.profile.role')
            ->whereHas('credentials.profile.role', function ($query) {
                $query->where('roleName', 'admin');
            })
            ->orderBy('created_at', 'desc')
            ->take(10) // Ambil 10 aktivitas terbaru
            ->get();

        // Aktivitas Karyawan
        $aktivitasKaryawan = UserActivity::with('credentials.profile.role')
            ->whereHas('credentials.profile.role', function ($query) {
                $query->where('roleName', 'enduser');
            })
            ->orderBy('created_at', 'desc')
            ->take(10) // Ambil 10 aktivitas terbaru
            ->get();

        // kelas terpopuler
        $kelasTerpopuler = Kelas::withCount('orders')
            ->withSum('orders', 'harga')
            ->withAvg('userkomentar', 'rating')
            ->orderBy('orders_count', 'desc')
            ->limit(5)
            ->get();

        $kelasTidakDiminati = Kelas::withCount('orders')
            ->withSum('orders', 'harga')
            ->withAvg('userkomentar', 'rating')
            ->orderBy('orders_count', 'asc')
            ->limit(5)
            ->get();

        $peringkatKaryawan = UserHasSkor::with(['credentials.profile'])
            ->orderBy('skor', 'desc')
            ->limit(5) // Batas jumlah yang ditampilkan
            ->get();
        
        return view('gondowangi.backend.dashboard.index', [
            'title' => 'Dashboard - Gondowangi',
            'data' => $dataorder,
            'kelas' => $kelasterbaru,
            'aktivitas' => $aktivitasUser,
            'totalkls' => $totalkelas,
            'kelasProses' => $kelasDalamProses, // Jumlah kelas dalam proses
            'kelasSelesai' => $kelasSelesai,    // Jumlah kelas yang selesai semua progressnya
            'bulan' => $bulan,
            'dataTransaksi' => $dataTransaksi,
            'videoTimes' => $videoTimes,
            'soalTimes' => $soalTimes,
            'dates' => $dates,
            'aktivitasAdmin' => $aktivitasAdmin,
            'aktivitasKaryawan' => $aktivitasKaryawan,
            'kelasTerpopuler' => $kelasTerpopuler,
            'kelasTidakDiminati' => $kelasTidakDiminati,
            'peringkatKaryawan' => $peringkatKaryawan
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
