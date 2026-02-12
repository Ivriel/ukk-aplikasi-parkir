<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::with('user')->latest()->paginate(5);

        return view('kendaraans.index', [
            'kendaraans' => $kendaraans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kendaraans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }

        Kendaraan::create($validatedData);
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Membuat data kendaraan',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('kendaraans.index')->with('success', 'Kendaraan baru berhasil dibuat');
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
    public function edit(Kendaraan $kendaraan)
    {
        return view('kendaraans.edit', [
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $validatedData = $request->validate([
            'plat_nomor' => 'required|string|max:15',
            'jenis_kendaraan' => 'required|string|max:20',
            'warna' => 'required|string|max:20',
            'pemilik' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        if ($request->hasFile('gambar')) {
            if ($kendaraan->gambar) {
                Storage::disk('public')->delete($kendaraan->gambar);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('kendaraan', 'public');
        }
        $kendaraan->update($validatedData);
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengupdate data kendaraan',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('kendaraans.index')->with('success', 'Kendaraan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        if ($kendaraan->gambar) {
            Storage::disk('public')->delete($kendaraan->gambar);
        }
        $kendaraan->delete();
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus data kendaraan',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('kendaraans.index')->with('success', 'Kendaraan berhasil dihapus');
    }
}
