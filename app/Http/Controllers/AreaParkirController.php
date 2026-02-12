<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areaParkirs = AreaParkir::all();

        return view('areaParkirs.index', [
            'areaParkirs' => $areaParkirs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areaParkirs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:1',
            'terisi' => 'nullable|numeric',
        ]);
        AreaParkir::create($validatedData);
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Membuat data area parkir',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('areaParkirs.index')->with('success', 'Area parkir berhasil dibuat');
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
    public function edit(AreaParkir $areaParkir)
    {
        return view('areaParkirs.edit', [
            'areaParkir' => $areaParkir,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_area' => 'required|string|max:50',
            'kapasitas' => 'required|numeric|min:1',
            'terisi' => 'nullable|numeric',
        ]);

        AreaParkir::where('id', '=', $id)->update($validatedData);
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengupdate data area parkir',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('areaParkirs.index')->with('success', 'Area parkir berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $areaParkir = AreaParkir::findOrFail($id);
        $areaParkir->delete();
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus data area parkir',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('areaParkirs.index')->with('success', 'Area parkir berhasil dihapus');
    }
}
