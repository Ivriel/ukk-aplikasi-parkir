<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarifs = Tarif::all();

        return view('tarifs.index', [
            'tarifs' => $tarifs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya|unique:tarifs,jenis_kendaraan',
            'tarif_per_jam' => 'required|min:1',
        ]);

        Tarif::create($validatedData);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Membuat data tarif',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('tarifs.index')->with('success', 'Berhasil membuat tarif baru');
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
    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', [
            'tarif' => $tarif,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'jenis_kendaraan' => 'required|in:motor,mobil,lainnya|unique:tarifs,jenis_kendaraan,'.$id,
            'tarif_per_jam' => 'required|min:1',
        ]);
        Tarif::where('id', '=', $id)->update($validatedData);
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengedit data tarif',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('tarifs.index')->with('success', 'Data tarif berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus data tarif',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('tarifs.index')->with('success', 'Berhasil menghapus tarif');
    }
}
