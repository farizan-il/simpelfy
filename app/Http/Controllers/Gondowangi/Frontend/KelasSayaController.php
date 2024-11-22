<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DetailModul;
use App\Models\Kelas;
use App\Models\KelasHasTest;
use App\Models\KomentarReply;
use App\Models\ModulKelas;
use App\Models\Orders;
use App\Models\Tests;
use App\Models\UserCredentials;
use App\Models\UserHasProgress;
use App\Models\UserHasSkor;
use App\Models\UserHasSpentTime;
use App\Models\UserKomentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KelasSayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        // Ambil semua kelas yang dipesan pengguna, termasuk relasi ke kelas dan userprogress
        $dataKelas = Orders::with(['kelas', 'userprogress'])->where('user_credentials_id', Auth::id())->get();

        return view('gondowangi.frontend.profile.kelassaya.index', [
            'title' => 'Kelas Saya - Gondowangi',
            'kelas' => $dataKelas
        ]);
    }

    public function saveTimeSpent(Request $request)
    {
        $validated = $request->validate([
            'modul_detail_id' => 'required|exists:detail_modul,id',
            'time_spent' => 'required|integer',
            'type' => 'required|string'
        ]);

        // Retrieve the UserHasProgress entry
        $userProgress = UserHasProgress::where([
            'modul_detail_id' => $validated['modul_detail_id'],
            'user_credentials_id' => auth()->id()
        ])->first();

        if ($userProgress) {
            UserHasSpentTime::create([
                'user_has_progress_id' => $userProgress->id,
                'spentTime' => $validated['time_spent'],
                'type' => $validated['type']
            ]);
        }

        return response()->json(['status' => 'success']);
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
        $pelajaran = Kelas::findOrFail($id);
        $benefits = explode('/', $pelajaran->keuntungan);

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

        return view('gondowangi.frontend.profile.kelassaya.show', [
            'title' => 'Pembelajaran - Gondowangi',
            'detailpelajaran' => $pelajaran,
            'keuntungan' => $benefits,
            'bagian' => $dataModul,
            'pelajaran' => $detailModuls,
            'komentar' => $datakomentar,
            'userHasComment' => $userHasComment,
            'totalRating' => number_format($totalRating, 2), 
            'totalReviews' => $totalReviews,
            'ratingCounts' => $ratingCounts,
            'newReviewsCount' => $newWeekReviewsCount,
            'preTest' => $preTest,
            'midTest' => $midTest,
            'postTest' => $postTest,
            'sections' => $jumlahModul,
            'lectures' => $jumlahDetailModul,
        ]);
    }

    public function updateStatus(Request $request, $modulDetailId)
    {
        $userId = auth()->id();

        // Cari progress record untuk pengguna saat ini dan modul detail yang ditentukan
        $userProgress = UserHasProgress::where('modul_detail_id', $modulDetailId)
            ->where('user_credentials_id', $userId)
            ->first();

        if ($userProgress) {
            $status = $request->input('status', 'selesai');
            $userProgress->status = $status;
            $userProgress->save();

            // Jika status selesai, simpan spent time jika belum ada
            if ($status === 'selesai') {
                // Cek apakah sudah ada record di UserHasSpentTime untuk user progress ini
                $spentTimeExists = UserHasSpentTime::where('user_has_progress_id', $userProgress->id)
                    ->where('type', 'video') // atau sesuaikan dengan tipe konten
                    ->exists();

                if (!$spentTimeExists) {
                    // Ambil durasi dari detail modul
                    $detailModul = DetailModul::find($modulDetailId);
                    if ($detailModul) {
                        // Buat record baru di UserHasSpentTime
                        UserHasSpentTime::create([
                            'user_has_progress_id' => $userProgress->id,
                            'spentTime' => $detailModul->duration, // durasi dalam menit
                            'type' => 'video' // atau sesuaikan dengan tipe konten
                        ]);
                    }
                }

                // Update skor seperti sebelumnya
                $userScore = UserHasSkor::firstOrCreate(
                    ['user_credentials_id' => $userId],
                    ['skor' => 0]
                );
                $userScore->increment('skor');
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Progress not found.']);
    }


    public function submitReview(Request $request, $id)
    {
        $request->validate([
            'komentartext' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        UserKomentar::create([
            'user_credentials_id' => auth()->id(),  // pastikan user login
            'kelas_id' => $id,
            'komentartext' => $request->komentartext,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Review berhasil disimpan!');
    }

    public function updateSpentTime(Request $request, $modulDetailId)
    {
        $userId = auth()->id();
        $timeSpent = $request->input('time_spent', 0); // Ambil waktu yang dihabiskan dari request

        // Temukan atau buat catatan kemajuan pengguna untuk modul detail yang diberikan
        $userProgress = UserHasProgress::firstOrCreate([
            'modul_detail_id' => $modulDetailId,
            'user_credentials_id' => $userId,
        ]);

        $userProgress->time_spent = $timeSpent;
        $userProgress->save();

        return response()->json(['success' => true]);
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