<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailModul;
use App\Models\Kelas;
use App\Models\KelasHasTest;
use App\Models\ModulKelas;
use App\Models\Orders;
use App\Models\Tests;
use App\Models\UserKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $detailKelas = Kelas::findOrFail($id);
        $benefits = explode('/', $detailKelas->keuntungan);
        $jumlahModul = ModulKelas::where('id_kelas', $id)->count();

        $modulIds = ModulKelas::where('id_kelas', $id)->pluck('id');
        $jumlahDetailModul = DetailModul::whereIn('id_modul', $modulIds)->count();
        
        $dataModul = ModulKelas::where('id_kelas', $id)->get();
        foreach ($dataModul as $modul) {
            // Get details for each modul's `DetailModul`
            $detailModuls = DetailModul::where('id_modul', $modul->id)->get();
            
            // Count total lessons and total duration in minutes
            $modul->lessonCount = $detailModuls->count();
            $modul->totalDurationMinutes = $detailModuls->sum('duration');

            // Format duration as hours/minutes
            if ($modul->totalDurationMinutes < 60) {
                $modul->formattedDuration = "{$modul->totalDurationMinutes} Menit";
            } else {
                $hours = floor($modul->totalDurationMinutes / 60);
                $minutes = $modul->totalDurationMinutes % 60;
                $modul->formattedDuration = "{$hours} Jam" . ($minutes > 0 ? " {$minutes} Menit" : '');
            }

            // Attach each modul's `DetailModul` data
            $modul->detailModuls = $detailModuls;

            // Attach mid-test for each modul
            $modul->midTest = Tests::where('modul_id', $modul->id)->where('type', 'mid-test')->first();
        }

        $detailModuls = DetailModul::whereIn('id_modul', $dataModul->pluck('id'))->get();

        // [-----------  awal kode untuk card detail kelas
        $totalPendaftar = Orders::where('kelas_id', $id)->count();
        // Fetch all module IDs for this class
        $modulIds = ModulKelas::where('id_kelas', $id)->pluck('id');

        // Menghitung jumlah video dan tes
        $videoCount = DetailModul::whereIn('id_modul', $modulIds)
            ->where(function($query) {
                $query->where('file', 'like', '%.mp4')
                    ->orWhere('file', 'like', 'http%');
            })
            ->count();

        $bagiantestCount = Tests::where('kelas_id', $id)->count();
        $testCount = Tests::where('kelas_id', $id)
            ->orWhereHas('modul', function($query) use ($id) {
                $query->where('id_kelas', $id);
            })
            ->count();


        // Total study duration (video durations + test durations)
        $totalDurationMinutes = DetailModul::whereIn('id_modul', ModulKelas::where('id_kelas', $id)->pluck('id'))
            ->where(function ($query) {
                $query->where('file', 'like', '%.mp4')
                    ->orWhere('file', 'like', 'http%');
            })
            ->sum('duration');

        $testDurationMinutes = Tests::where('kelas_id', $id)->sum('duration');
        
        $totalDurationMinutes += $testDurationMinutes;

        // Format duration
        if ($totalDurationMinutes < 60) {
            $formattedDuration = "{$totalDurationMinutes} Menit";
        } else {
            $hours = floor($totalDurationMinutes / 60);
            $minutes = $totalDurationMinutes % 60;
            $formattedDuration = $hours . ' Jam' . ($minutes > 0 ? " {$minutes} Menit" : '');
        }
        
        // [----------- akhir kode untuk card detail kelas

        // komentar kode
        $datakomentar = UserKomentar::with([  'credentials'])
            ->where('kelas_id', $id)
            ->get();
        
        $userHasComment = UserKomentar::where('kelas_id', $id)
            ->where('user_credentials_id', auth()->id())
            ->exists();

        $totalRating = UserKomentar::where('kelas_id', $id)->avg('rating');
        $totalReviews = UserKomentar::where('kelas_id', $id)->count();
        
        // Hitung jumlah rating per bintang
        $ratingCounts = UserKomentar::select('rating', DB::raw('count(*) as count'))
            ->where('kelas_id', $id)
            ->groupBy('rating')
            ->pluck('count', 'rating')->toArray();
        
        $newWeekReviewsCount = UserKomentar::where('kelas_id', $id)
            ->where('created_at', '>=', now()->subWeek())
            ->count();

        // Get Pre-Test, Mid-Test, and Post-Test data
        $preTest = Tests::where('type', 'pre-test')->where('kelas_id', $id)->first();
        $midTest = Tests::where('type', 'mid-test')->where('modul_id', $id)->first();
        $postTest = Tests::where('type', 'post-test')->where('kelas_id', $id)->first();

        return view('gondowangi.frontend.kelas.index', [
            'title' => 'Detail Kelas - Gondowangi',
            'detail' => $detailKelas,
            'benefits' => $benefits,
            'sections' => $jumlahModul,
            'lectures' => $jumlahDetailModul,
            'modul' => $dataModul,
            'detailModuls' => $detailModuls,
            'komentar' => $datakomentar,
            'userHasComment' => $userHasComment,
            'totalRating' => number_format($totalRating, 2), 
            'totalReviews' => $totalReviews,
            'ratingCounts' => $ratingCounts,
            'newReviewsCount' => $newWeekReviewsCount,
            'registeredCount' => $totalPendaftar,
            'videoCount' => $videoCount,
            'testCount' => $testCount,
            'totalStudyDuration' => $formattedDuration,
            'preTest' => $preTest,
            'midTest' => $midTest,
            'postTest' => $postTest,
            'bagiantestCount' => $bagiantestCount
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