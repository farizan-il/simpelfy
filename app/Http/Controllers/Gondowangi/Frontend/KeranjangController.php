<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\CodeCleaner\ReturnTypePass;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKeranjang = Keranjang::where('user_credentials_id', Auth::id())->get();
        
        $totalHarga = $dataKeranjang->sum(function($item) {
            return $item->kelas->harga;
        });
        
        $gonpayUser = auth()->user()->gonpay;
        return view('gondowangi.frontend.keranjang.index', [
            'title' => 'Keranjang - Gondowangi',
            'keranjang' => $dataKeranjang,
            'total' => $totalHarga,
            'gonpayUser' => $gonpayUser
        ]);
    }

    public function tambah(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Cek apakah user sudah login
        if (Auth::check()) {
            // Cek jika kelas sudah ada di keranjang
            $isAlreadyInCart = Keranjang::where('user_credentials_id', Auth::id())
                ->where('kelas_id', $request->kelas_id)
                ->exists();

            if (!$isAlreadyInCart) {
                // Masukkan data ke dalam tabel keranjang
                Keranjang::create([
                    'user_credentials_id' => Auth::id(),
                    'kelas_id' => $request->kelas_id,
                ]);

                return back()->with('success', 'Kelas berhasil ditambahkan ke keranjang!');
            } else {
                return back()->with('error', 'Kelas ini sudah ada di keranjang!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }
    }

    public function prosesBeli(Request $request)
    {
        // Ambil data keranjang dari user
        $keranjang = Keranjang::where('user_credentials_id', auth()->id())->get();

        // Kalkulasi total
        $total = $keranjang->sum(function($item) {
            return $item->kelas->harga;
        });

        // Bawa data keranjang dan total ke halaman paymentkelas
        return redirect()->route('paymentkelas.index')
                        ->with(['keranjang' => $keranjang, 'total' => $total]);
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
    public function destroy($id)
    {
        $item = Keranjang::find($id);
        
        if ($item) {
            $item->delete();
            return redirect('keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
        }

        return redirect('keranjang')->with('error', 'Item tidak ditemukan.');
    }

}
