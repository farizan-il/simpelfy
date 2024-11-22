<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\KelasHasTest;
use App\Models\TestHasSoal;
use App\Models\Tests;
use Illuminate\Http\Request;

class ujianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kelasId)
    {
        $preTest = Tests::where('kelas_id', $kelasId)
            ->where('type', 'Pre-test')
            ->with(['questions'])
            ->first();

        foreach ([$preTest] as $test) {
            if ($test) {
                foreach ($test->questions as $soal) {
                    if (is_string($soal->options)) {
                        $soal->options = json_decode($soal->options, true);
                    }
                }
            }
        }

        return view('gondowangi.frontend.profile.kelassaya.test.test', [
            'title' => 'Pre-Test - Gondowangi',
            'preTest' => $preTest,
        ]);
    }

    public function selesai(Request $request, $kelasId)
    {
        $preTest = Tests::where('kelas_id', $kelasId)
            ->where('type', 'Pre-test')
            ->with(['questions'])
            ->first();

        $userAnswers = $request->input('answer'); // Mendapatkan semua jawaban dari form
        $results = [];
        
        // Proses jawaban
        foreach ($preTest->questions as $index => $question) {
            $userAnswer = $userAnswers[$index] ?? null; // Menangkap jawaban pengguna
            $correctAnswer = $question->correct_answer; // Asumsi bahwa ada kolom 'correct_answer' di database
            
            $isCorrect = ($userAnswer == $correctAnswer);
            
            // Menyimpan hasil dan penjelasan
            $results[] = [
                'question' => $question->questionText,
                'userAnswer' => $question->options[$userAnswer] ?? 'Tidak dijawab',
                'correctAnswer' => $question->options[$correctAnswer],
                'isCorrect' => $isCorrect,
                'explanation' => $question->explanation ?? 'Penjelasan tidak tersedia',
            ];
        }
        
        return view('hasil', [
            'results' => $results
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



