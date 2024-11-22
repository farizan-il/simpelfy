<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\DetailModul;
use App\Models\Kelas;
use App\Models\KelasHasTest;
use App\Models\ModulKelas;
use App\Models\TestHasSoal;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ModulKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dataKelas = Kelas::where('title', 'like', "%$search%")
            ->orWhereHas('kategori', function($query) use ($search) {
                $query->where('namaKategori', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')  // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(10);

        return view('gondowangi.backend.modulkelas.index', [
            'title' => 'Kelola Modul Kelas - Gondowangi',
            'kelas' => $dataKelas
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
        $ValidatedData = $request->validate([
            'id_kegiatan' => 'required',
            'judulModul' => 'required|max:255',
            'File.*' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx,mp4|max:20480',
            'Link.*' => 'nullable|url',
            'DetailModul.*' => 'required|string',
        ]);

        $modul = ModulKelas::create([
            'id_kelas' => $ValidatedData['id_kegiatan'],
            'judulModul' => $ValidatedData['judulModul'],
        ]);

        if ($modul) {
            $fileInputs = $request->file('File') ?? [];
            $linkInputs = $request->Link ?? [];

            $totalItems = max(count($fileInputs), count($linkInputs));

            for ($index = 0; $index < $totalItems; $index++) {
                $filename = null;

                if (isset($fileInputs[$index])) {
                    // Proses file jika ada
                    $file = $fileInputs[$index];
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . $index . '.' . $extension;

                    // Jika file adalah gambar, resize dan simpan, jika bukan, simpan langsung
                    if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                        Image::make($file)->resize(370, 390)->save(public_path('video/' . $filename));
                    } else {
                        $file->move(public_path('files/kursus/'), $filename);
                    }
                } elseif (isset($linkInputs[$index])) {
                    // Simpan link jika tidak ada file pada index yang sama
                    $filename = $linkInputs[$index];
                }

                if ($filename) {
                    // Simpan detail modul hanya jika ada file atau link
                    DetailModul::create([
                        'id_modul' => $modul->id,
                        'file' => $filename,
                        'detailSubModul' => $ValidatedData['DetailModul'][$index],
                        'duration' => $request->durasi,
                    ]);
                }
            }

            return back()->with('success', 'Modul Materi berhasil ditambahkan!');
        }

        return back()->with('error', 'Modul Materi gagal ditambahkan!');
    }

    public function addPreTest(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'type' => 'required|in:pre-test,mid-test,post-test',
            'duration' => 'required|integer',
            'questionText' => 'required|string',
            'options' => 'required|json',
            'correctAnswer' => 'required|string',
            'explanation' => 'nullable|string',
        ]);

        // Insert data into KelasHasTest table
        $kelasHasTest = KelasHasTest::create([
            'kelas_id' => $request->kelas_id,
            'type' => $request->type,
            'duration' => $request->duration,
        ]);

        // Insert data into TestHasSoal table using the KelasHasTest ID
        TestHasSoal::create([
            'kelas_has_test_id' => $kelasHasTest->id,
            'questionText' => $request->questionText,
            'options' => $request->options,
            'correctAnswer' => $request->correctAnswer,
            'explanation' => $request->explanation,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
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
        $kelas = Kelas::findOrFail($id);
    
        $modulKelas = ModulKelas::where('id_kelas', $id)->with('detailModul')->get();

        return view('gondowangi.backend.modulkelas.edit', [
            'title' => 'Menambahkan Modul Kelas - Gondowangi',
            'kelas' => $kelas,
            'modulKelas' => $modulKelas  // Pastikan ini adalah koleksi modul untuk kelas tertentu
        ]);

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
        try {
            // Menghapus data dari tabel DetailModul
            $details = DetailModul::where('id_modul', $id)->get();
    
            foreach ($details as $detail) {
                $imagePath = public_path('image/' . $detail->file);
                $filePath = public_path('video/' . $detail->file);
    
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
    
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
    
            DetailModul::where('id_modul', $id)->delete();
    
            // Menghapus data dari tabel Modul
            $modul = ModulKelas::find($id);
            $modul->delete();
    
            return response()->json(['success' => 'Modul berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }

}
