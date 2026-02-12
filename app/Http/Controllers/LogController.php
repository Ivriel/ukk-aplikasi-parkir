<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;

class LogController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')->latest()->paginate(10);

        return view('logAktivitas.index', [
            'logs' => $logs,
        ]);
    }
}
