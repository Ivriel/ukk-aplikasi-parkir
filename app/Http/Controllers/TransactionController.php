<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query()->with(['user', 'kendaraan', 'tarif', 'area']);
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->whereHas('kendaraan', function ($sub) use ($search) {
                    $sub->where('plat_nomor', 'like', "%{$search}%");
                })->orWhereHas('area', function ($sub) use ($search) {
                    $sub->where('nama_area', 'like', "%{$search}%");
                });
            });
        }

        if (Auth::user()->role === 'owner') {
            if ($request->filled('dari_tanggal') && $request->filled('sampai_tanggal')) {

                $query->whereBetween('waktu_masuk', [
                    $request->dari_tanggal.' 00:00:00',
                    $request->sampai_tanggal.' 23:59:59',
                ]);
            } elseif ($request->filled('dari_tanggal')) {
                $query->whereDate('waktu_masuk', '>=', $request->dari_tanggal);
            } elseif ($request->filled('sampai_tanggal')) {
                $query->whereDate('waktu_masuk', '<=', $request->sampai_tanggal);
            }
        }

        if ($request->sort == 'termurah') {
            $query->orderBy('biaya_total', 'asc');
        } elseif ($request->sort == 'termahal') {
            $query->orderBy('biaya_total', 'desc');
        } elseif ($request->sort == 'terlama') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->latest();
        }

        $transaksis = $query->paginate(5)->withQueryString();

        return view('transaksis.index', [
            'transaksis' => $transaksis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $kendaraanQuery = Kendaraan::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $kendaraanQuery->where(function ($q) use ($search) {
                $q->where('plat_nomor', 'like', "%{$search}%")
                    ->orWhere('jenis_kendaraan', 'like', "%{$search}%")
                    ->orWhere('warna', 'like', "%{$search}%")
                    ->orWhere('pemilik', 'like', "%{$search}%");
            });
        }

        $kendaraan = $kendaraanQuery->get();
        $tarif = Tarif::all();
        $area = AreaParkir::all();

        return view('transaksis.create', [
            'kendaraan' => $kendaraan,
            'tarif' => $tarif,
            'area' => $area,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|numeric|exists:area_parkirs,id',
            'kendaraan_id' => 'required|numeric|exists:kendaraans,id',
            'tarif_id' => 'required|numeric|exists:tarifs,id',
        ]);
        $areaParkir = AreaParkir::findOrFail($request->area_id);
        if ($areaParkir->terisi >= $areaParkir->kapasitas) {
            return back()->with('error', 'Parkir penuh. silahkan cari parkir lain');
        }

        Transaksi::create([
            'area_id' => $request->area_id,
            'kendaraan_id' => $request->kendaraan_id,
            'tarif_id' => $request->tarif_id,
            'user_id' => Auth::id(),
            'status' => 'masuk',
            'waktu_masuk' => now(),
        ]);
        $areaParkir->increment('terisi');

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Membuat transaksi parkir masuk',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Berhasil membuat transaksi parkir masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaksi::with(['kendaraan', 'tarif', 'user', 'area'])->findOrFail($id);

        return view('transaksis.show', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::with('area', 'user')->findOrFail($id);

        return view('transaksis.edit', [
            'transaksi' => $transaksi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::with('area')->findOrFail($id);
        if ($transaksi->status === 'keluar') {
            return redirect()->back()->with('error', 'sudah pernah keluar');
        }

        $waktuKeluar = now();
        $selisihMenit = Carbon::parse($transaksi->waktu_masuk)->diffInMinutes($waktuKeluar);
        $durasiJam = ceil($selisihMenit / 60);
        if ($durasiJam <= 0) {
            $durasiJam = 1;
        }

        $tarifPerJam = $transaksi->tarif->tarif_per_jam;

        $totalBiaya = $durasiJam * $tarifPerJam;
        $transaksi->update([
            'status' => 'keluar',
            'waktu_keluar' => $waktuKeluar,
            'biaya_total' => $totalBiaya,
            'durasi_jam' => $durasiJam,
        ]);

        if ($transaksi->area->terisi > 0) {
            $transaksi->area->decrement('terisi');
        }

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Membuat transaksi parkir keluar',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('transaksis.index')->with('success', 'berhasil mengedit status transaksi parkir');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function printStruk($id)
    {
        $transaksi = Transaksi::with('user', 'kendaraan', 'area', 'tarif')->findOrFail($id);
        $data = [
            'transaksi' => $transaksi,
            'tanggal_dicetak' => now()->format('d/m/Y H:i:s'),
        ];

        $pdf = Pdf::loadView('transaksis.print', $data);
        $pdf->setPaper([0, 0, 600, 800], 'portrait');

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mencetak struk transaksi parkir',
            'waktu_aktivitas' => now(),
        ]);

        return $pdf->stream('struk-parkir-#'.$transaksi->id.'.pdf');
    }
}
