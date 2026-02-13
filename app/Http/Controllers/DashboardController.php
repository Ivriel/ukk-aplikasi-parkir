<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $hour = now()->format('H');
        $greeting = match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam'
        };

        $data = [
            'greeting' => $greeting,
            'user_fullname' => $user->nama_lengkap,
            'user_role' => $user->role,
            'total_kendaraan' => Kendaraan::count(),
            'total_transaksi' => Transaksi::count(),
            'total_transaksi_masuk' => Transaksi::where('status', 'masuk')->count(),
            'total_transaksi_keluar' => Transaksi::where('status', 'keluar')->count(),
            'total_user' => User::count(),
            'total_pendapatan' => Transaksi::sum('biaya_total'),
            'total_jam_parkir' => Transaksi::sum('durasi_jam'),
            'log_user_terdeteksi' => LogAktivitas::count(),
            'kendaraan_mobil' => Kendaraan::where('jenis_kendaraan', 'mobil')->count(),
            'kendaraan_motor' => Kendaraan::where('jenis_kendaraan', 'motor')->count(),
            'kendaraan_lainnya' => Kendaraan::where('jenis_kendaraan', 'lainnya')->count(),
            'user_owner' => User::where('role', 'owner')->count(),
            'user_admin' => User::where('role', 'admin')->count(),
            'user_petugas' => User::where('role', 'petugas')->count(),
        ];

        return view('dashboard', $data);
    }
}
