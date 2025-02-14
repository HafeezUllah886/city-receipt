<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\opd_time;

class OpdTimeController extends Controller
{
    public function index()
    {
        $opd_time = opd_time::first();
        return view('opd_time.index', compact('opd_time'));
    }

    public function update(Request $request)
    {
        $opd_time = opd_time::first();
        $opd_time->time = $request->time;
        $opd_time->gap = $request->gap;
        $opd_time->save();
        return redirect()->route('opdtime.index');
    }
}
