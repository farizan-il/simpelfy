<?php

namespace App\Http\Controllers\Gondowangi\Authentication;

use App\Http\Controllers\Controller;
use App\Models\KategoriKelas;
use App\Models\UserActivity;
use App\Models\UserCredentials;
use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthentifikasiController extends Controller
{
    public function showLoginForm()
    {
        return view('Gondowangi.Authentication.Backend.index', [
            'title' => 'Login - Gondowangi'
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Ambil data email atau username
        $email = $request->input('email');
        $password = $request->input('password');

        // Cari user berdasarkan email
        $auth = UserCredentials::where('email', $email)->first();

        if ($auth) {
            // Cek apakah password benar
            if (Hash::check($password, $auth->password)) {
                // Cek apakah akun sudah diaktivasi
                if ($auth->isActive == 1) {
                    // Ambil role dari profile user
                    $role = $auth->profile ? $auth->profile->role->roleName : null;

                    // Redirect berdasarkan role
                    if ($role === 'superadmin') {
                        Auth::login($auth);
                        return redirect('/dashboard')->with('success', 'Login berhasil sebagai Superadmin!');
                    } elseif ($role === 'enduser') {
                        Auth::login($auth);

                        UserActivity::create([
                            'user_credentials_id' => $auth->id,
                            'aktivitas' => 'Login',
                            'keterangan' => 'Masuk ke aplikasi pembelajaran'
                        ]);

                        return redirect('/dashboarduser');
                    } else {
                        return redirect('/masuk')->with('error', 'Role tidak valid!');
                    }
                } else {
                    Auth::login($auth);
                    return redirect('/onboarding');
                }
            } else {
                return redirect('/masuk')->with('error', 'Kata sandi yang Anda masukkan salah!');
            }
        } else {
            return redirect('/masuk')->with('error', 'Pengguna yang Anda masukkan tidak terdaftar!');
        }
    }

    public function showOnboardingForm()
    {
        return view('Gondowangi.Authentication.onboard', [
            'title' => 'Onboarding - Gondowangi',
            'kategoriList' => KategoriKelas::where('namaKategori', '!=', 'onboarding')->get()
        ]);
    }

    public function submitOnboardingForm(Request $request)
    {
        $user = UserCredentials::find(Auth::id());

        $request->validate([
            'kategori' => 'required|array|max:5'
        ]);

        foreach ($request->input('kategori') as $kategoriId) {
            UserPreference::create([
                'user_credentials_id' => $user->id,
                'kategori_id' => $kategoriId
            ]);
        }

        $user->isActive = 1;
        $user->save();

        UserActivity::create([
            'user_credentials_id' => $user->id,
            'aktivitas' => 'Autentifikasi',
            'keterangan' => 'Login pertama kali'
        ]);

        return redirect('/dashboardkaryawan')->with('success', 'Onboarding selesai, selamat belajar!');
    }

    public function logout(Request $request)
    {
        UserActivity::create([
            'user_credentials_id' => Auth::user()->id,
            'aktivitas' => 'Logout',
            'keterangan' => 'Pengguna keluar dari sistem',
            'created_at' => now()
        ]);

        // Lanjutkan dengan proses logout
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/masuk')->with('success', 'Anda telah keluar!');
    }
}



