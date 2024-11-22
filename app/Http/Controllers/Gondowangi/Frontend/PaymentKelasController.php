<?php

namespace App\Http\Controllers\Gondowangi\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Keranjang;
use App\Models\Orders;
use App\Models\UserActivity;
use App\Models\UserHasProgress;
use App\Models\VoucherKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data item yang dicentang dari request
        $checkedItems = $request->input('items', []);
        
        if (empty($checkedItems)) {
            return redirect()->route('keranjang.index')->withErrors('Tidak ada kelas yang dipilih.');
        }

        // Ambil data keranjang berdasarkan item yang dicentang
        $keranjang = Keranjang::whereIn('id', $checkedItems)->get();
        
        $total = $keranjang->sum(function($item) {
            return $item->kelas->harga;
        });

        $gonpayUser = auth()->user()->gonpay;
        if ($gonpayUser < $total) {
            return redirect()->back()->with('error', 'Dibilangin saldonya gak cukup, gimana sih....');
        }

        // Simpan keranjang dan total ke session
        session(['keranjang' => $keranjang, 'total' => $total]);

        return view('gondowangi.frontend.paymentkelas.index', [
            'title' => 'Payment - Gondowangi',
            'keranjang' => $keranjang,
            'total' => $total
        ]);
    }

    // pindahkan ke controller kelas
    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        if (Auth::check()) {
            $isAlreadyInCart = Keranjang::where('user_credentials_id', Auth::id())
                ->where('kelas_id', $request->kelas_id)
                ->exists();

            if (!$isAlreadyInCart) {
                Keranjang::create([
                    'user_credentials_id' => Auth::id(),
                    'kelas_id' => $request->kelas_id,
                ]);

                return redirect()->route('keranjang.index')->with('success', 'Kelas berhasil ditambahkan ke keranjang!');
            } else {
                return redirect()->route('keranjang.index')->with('error', 'Kelas ini sudah ada di keranjang!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Silahkan login terlebih dahulu!');
        }
    }

    public function applyVoucher(Request $request)
    {
        $voucherCode = $request->kodeVoucher;
        $kelasId = $request->kelasId;

        // Cari voucher di database
        $voucher = VoucherKelas::where('kodeVoucher', $voucherCode)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        // Cek apakah voucher ada dan masih berlaku
        if ($voucher) {
            // Dapatkan kelas dan hitung harga dengan potongan
            $kelas = Kelas::find($kelasId);
            $potonganHarga = min($voucher->potonganHarga, $kelas->harga);
            $hargaSetelahDiskon = $kelas->harga - $potonganHarga;

            return response()->json([
                'success' => true,
                'potonganHarga' => $potonganHarga,
                'hargaSetelahDiskon' => $hargaSetelahDiskon,
                'kodeVoucher' => $voucher->kodeVoucher
            ]);
        }

        // Jika voucher tidak valid atau kadaluarsa
        return response()->json([
            'success' => false,
            'message' => 'Voucher tidak valid atau telah kadaluwarsa'
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
        $keranjang = session('keranjang');
        $userId = auth()->user();
        $totalHarga = 0;

        if (empty($keranjang)) {
            return redirect()->route('keranjang.index')->withErrors('Keranjang kosong. Tidak ada kelas yang dipilih.');
        }

        foreach ($keranjang as $item) {
            $totalHarga += $item->kelas->harga; 
        }

        $userId->gonpay -= $totalHarga;
        $userId->save();

        foreach ($keranjang as $item) {
            // Buat entri baru di tabel orders
            $order = Orders::create([
                'user_credentials_id' => $userId->id,
                'kelas_id' => $item->kelas_id,
                'harga' => $totalHarga,
                'tanggalPembelian' => Carbon::now(),
                'masaAktif' => Carbon::now()->addWeeks(2) 
            ]);

            $moduls = $item->kelas->modul;

            foreach ($moduls as $modul) {
                // Masukkan setiap detail modul ke user_has_progress
                foreach ($modul->detailModul as $detailModul) {
                    UserHasProgress::create([
                        'modul_detail_id' => $detailModul->id,
                        'orders_id' => $order->id,
                        'user_credentials_id' => $userId->id,
                        'status' => 'proses',
                    ]);
                }

                // Jika modul memiliki mid-test, tambahkan ke user_has_progress
                if ($modul->midTest) {
                    UserHasProgress::create([
                        'tests_id' => $modul->midTest->id,
                        'orders_id' => $order->id,
                        'user_credentials_id' => $userId->id,
                        'status' => 'proses',
                    ]);
                }
            }

            // Jika kelas memiliki pre-test, tambahkan ke user_has_progress
            if ($item->kelas->preTest) {
                UserHasProgress::create([
                    'tests_id' => $item->kelas->preTest->id,
                    'orders_id' => $order->id,
                    'user_credentials_id' => $userId->id,
                    'status' => 'proses',
                ]);
            }

            // Jika kelas memiliki post-test, tambahkan ke user_has_progress
            if ($item->kelas->postTest) {
                UserHasProgress::create([
                    'tests_id' => $item->kelas->postTest->id,
                    'orders_id' => $order->id,
                    'user_credentials_id' => $userId->id,
                    'status' => 'proses',
                ]);
            }

            // Simpan aktivitas pembelian ke tabel userActivity
            UserActivity::create([
                'user_credentials_id' => $userId->id,
                'aktivitas' => 'Pembelian',
                'keterangan' => 'Membeli kelas: ' . $item->kelas->title,
            ]);

            // Hapus item dari keranjang setelah proses selesai
            $item->delete();
        }

        session()->forget('keranjang');
        return redirect()->route('kelassaya.index')->with('success', 'Pembayaran berhasil diselesaikan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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