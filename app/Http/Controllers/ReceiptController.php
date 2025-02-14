<?php

namespace App\Http\Controllers;

use App\Models\receipt;
use App\Http\Controllers\Controller;
use App\Models\charges;
use App\Models\opd_time;
use App\Models\receipt_details;
use App\Models\receipt_type;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use NumberFormatter;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $receipts = receipt::orderBy('id', 'desc')->paginate(100);

        return view('receipt.index', compact('receipts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id = 1)
    {

        $types = receipt_type::all();
        $charges = charges::where('typeID', $id)->get();

        $date = date('Y-m-d'); // Replace with the desired date

        $missingNumbers = receipt::whereDate('date', $date)
            ->pluck('token_number')
            ->toArray();

            $numbers = range(1, 150);
            $missing = array_diff($numbers, $missingNumbers);

            $firstMissing = reset($missing);

        return view('receipt.create', compact('types','charges', 'id', 'firstMissing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            if($request->isNotFilled('id'))
            {
                throw new Exception('Please Select Atleast One Item');
            }
            DB::beginTransaction();
            $type = receipt_type::find($request->type);

            $opdtime = opd_time::first();
            $gap = $opdtime->gap * $request->token;
            $newTime = Carbon::parse($opdtime->time)->addMinutes($gap);
            $receipt = receipt::create(
                [
                    'type' => $type->type,
                    'date' => $request->date,
                    'consultant' => $request->consultant,
                    'pName' => $request->pName,
                    'contact' => $request->contact,
                    'desc' => $request->notes,
                    'cnic' => $request->cnic,
                    'gender' => $request->gender,
                    'token_number' => $request->token,
                    'time' => $newTime,
                    'userID' => auth()->user()->id,
                ]
            );

            $ids = $request->id;
            foreach($ids as $key => $id)
            {
                receipt_details::create(
                    [
                        'receiptID' => $receipt->id,
                        'itemID' => $request->id[$key],
                        'name' => $request->text[$key],
                        'fee' => $request->rate[$key],
                    ]
                );
            }

            DB::commit();
            return to_route('receipt.print', $receipt->id);
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(receipt $receipt)
    {
        //
    }

    public function print($id)
    {
        $receipt = receipt::find($id);
        $number = $receipt->details->sum('fee');
        $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        $numberInWords = $formatter->format($number);
        return view('receipt.print', compact('receipt', 'numberInWords'));
    }
    public function print1($id)
    {
        $receipt = receipt::find($id);
        $number = $receipt->details->sum('fee');
        $formatter = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
        $numberInWords = $formatter->format($number);
        return view('receipt.print1', compact('receipt', 'numberInWords'));
    }

    public function refund($id)
    {
        $receipt = receipt::find($id);
        $receipt->update(
            [
                'refunded' => 'yes',
                'refundedBy' => auth()->user()->name,
                'refundedDate' => now(),
            ]
        );

        session()->forget('confirmed_password');
        return to_route('receipt.index')->with('error', "Receipt Refunded");
    }

    public function checktoken($token, $date)
    {
        $receipt = receipt::where('token_number', $token)
            ->whereDate('date', $date)
            ->first();
        if ($receipt)
            return 1;
        else
            return 0;
    }
}
