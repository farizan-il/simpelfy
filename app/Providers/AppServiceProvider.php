<?php

namespace App\Providers;

use App\Models\KategoriKelas;
use App\Models\KelasWajib;
use App\Models\Keranjang;
use App\Models\NotifikasiForUser;
use App\Models\Orders;
use App\Models\Pengaduan;
use App\Models\UserKomentar;
use App\Models\UserPreference;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Komposer view untuk mengirim jumlah keranjang ke semua view
        View::composer('*', function ($view) {
            $jumlahKeranjang = 0;
            $jumlahPengaduanInProgress = 0;

            if (Auth::check()) {
                // Hitung jumlah item di keranjang
                $jumlahKeranjang = Keranjang::where('user_credentials_id', Auth::id())->count();

                // Hitung jumlah pengaduan dengan status 'in_progress'
                $jumlahPengaduanInProgress = Pengaduan::where('status', 'in_progress')
                    ->count();
            }

            // Kirim variabel ke semua view
            $view->with([
                'jumlahKeranjang' => $jumlahKeranjang,
                'jumlahPengaduanInProgress' => $jumlahPengaduanInProgress,
            ]);
        });

        View::composer('*', function ($view) {

            $kategori = KategoriKelas::with('subkategori')
                ->where('namaKategori', '!=', 'onboarding') // Menghapus kategori 'onboarding'
                ->get();
    
            // Jika pengguna login
            if (Auth::check()) {
                // Ambil departemen pengguna
                $userProfile = Auth::user()->profile;
                $userDepartement = $userProfile ? $userProfile->departement->departement : null;
    
                // Ambil preferensi pengguna (kategori yang tertarik)
                $userPreferences = UserPreference::where('user_credentials_id', Auth::id())->pluck('kategori_id')->toArray();
    
                // Pisahkan kategori yang sesuai dengan departemen dan preferensi pengguna
                $departementKategori = $kategori->filter(function($item) use ($userDepartement) {
                    return $item->namaKategori === $userDepartement;
                });
    
                $preferredKategori = $kategori->filter(function($item) use ($userPreferences) {
                    return in_array($item->id, $userPreferences);
                });
    
                // Ambil kategori selain departemen dan preferensi
                $otherKategori = $kategori->diff($preferredKategori)->diff($departementKategori); 
    
                // Gabungkan kategori dengan urutan yang diinginkan: pertama kategori selain departemen dan preferensi, lalu preferensi, dan departemen terakhir
                $sortedKategori = $otherKategori->merge($preferredKategori)->merge($departementKategori);
            } else {
                // Jika tidak login, urutan kategori acak
                $sortedKategori = $kategori->shuffle(); // Mengacak kategori
            }
    
            // Kirimkan kategori yang sudah diurutkan atau diacak ke semua view
            $view->with('kategori', $sortedKategori);
        });
        
        // Komposer view untuk mengirim jumlah kelas yg udah di beli
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $jumlahkelassaya = Orders::where('user_credentials_id', Auth::id())->count();
            } else {
                $jumlahkelassaya = 0; // Jika belum login, set ke 0
            }
            // Kirim variabel ke semua view
            $view->with('jumlahkelassaya', $jumlahkelassaya);
        });

        // Komposer view untuk mengirim notifikasi
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $notifikasi = NotifikasiForUser::where('user_credentials_id', Auth::id())->get();
            } else {
                $notifikasi = 0;
            }
            // Kirim variabel ke semua view
            $view->with('notifikasi', $notifikasi);
        });

        // Bagikan jumlah komentar dengan status 'Draf' ke semua view
        View::composer('*', function ($view) {
            $jumlahDraf = UserKomentar::where('status', 'Draf')->count();
            $view->with('jumlahDraf', $jumlahDraf);
        });

        // Komposer view untuk mengirim jumlah kelas wajib
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userDepartementId = Auth::user()->profile->departement_id;
                $userGolonganId = Auth::user()->profile->golongan_id;
                $userId = Auth::id();
    
                // Hitung jumlah kelas wajib yang belum dibeli
                $jumlahKelasWajib = KelasWajib::where('departement_id', $userDepartementId)
                    ->where('golongan_id', $userGolonganId)
                    ->whereDoesntHave('kelas.orders', function ($q) use ($userId) {
                        $q->where('user_credentials_id', $userId);
                    })
                    ->count();
            } else {
                $jumlahKelasWajib = 0;
            }
    
            // Kirim variabel ke semua view
            $view->with('jumlahKelasWajib', $jumlahKelasWajib);
        });

        Carbon::setLocale('id');
    }
}