<?php

namespace App\Http\Controllers\Gondowangi\Backend;

use App\Http\Controllers\Controller;
use App\Models\DetailModul;
use App\Models\ModulKelas;
use App\Models\NotifikasiForUser;
use App\Models\Orders;
use App\Models\UserCredentials;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

class AktivitasKaryawanController extends Controller
{
    public function index()
    {
        $aktivitasUser = Orders::with('kelas', 'userprogress')->get();
        return view('gondowangi.backend.aktivitaskaryawan.index', [
            'title' => 'Aktivitas Karyawan - Gondowangi',
            'aktivitas' => $aktivitasUser,
        ]);
    }

    // Metode untuk mengirim notifikasi
    public function sendNotification(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_credentials_id' => 'required|exists:usercredentials,id',
            'message' => 'required|string|max:500'
        ]);

        // Ambil data pengguna berdasarkan ID
        $user = UserCredentials::findOrFail($request->user_credentials_id);

        // Simpan notifikasi ke database
        NotifikasiForUser::create([
            'user_credentials_id' => $user->id,
            'kalimat' => $request->message
        ]);

        // Kirim email ke pengguna
        Mail::send('mails.notification', ['notifyMessage' => $request->message], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Notifikasi Penting');
        });

        return redirect()->back()->with('success', 'Notifikasi berhasil dikirim dan disimpan.');
    }
}
