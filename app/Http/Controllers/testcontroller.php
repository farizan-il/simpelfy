<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class testcontroller extends Controller
{
    public function index()
    {
        $departement = Departement::all();
        return view('test', [
            'title' => 'Kelola Kelas - Gondowangi',
            'dataDepartement' => $departement
        ]);
    }
    public function getChartData(Request $request)
    {
        $department = $request->input('department');
        $month = $request->input('month');

        // Query data berdasarkan departemen dan bulan
        $data = $this->queryChartData($department, $month);

        return response()->json([
            'datasets' => [
                [
                    'label' => 'Minggu Pertama',
                    'data' => $data['week1'],
                    'backgroundColor' => 'rgba(26, 115, 232, 0.18)',
                    'borderColor' => '#008DDA',
                    'borderWidth' => 1.5
                ],
                // Tambahkan dataset untuk minggu lainnya
            ]
        ]);
    }

}
