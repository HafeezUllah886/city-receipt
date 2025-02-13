<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\receipt;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function print(request $request)
    {
        $receipts = receipt::whereDate('date', $request->date)->where('userID', auth()->user()->id)->get();
        $refunded = receipt::whereDate('refundedDate', $request->date)->where('refundedBy', auth()->user()->name)->get();
        return view('report.print', compact('receipts', 'refunded'));
    }
}
