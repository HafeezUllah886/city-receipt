<?php

use App\Models\material_stock;
use App\Models\receipt;
use App\Models\stock;
use Carbon\Carbon;

function firstDayOfMonth()
{
    $startOfMonth = Carbon::now()->startOfMonth();

    return $startOfMonth->format('Y-m-d');
}
function lastDayOfMonth()
{

    $endOfMonth = Carbon::now()->endOfMonth();

    return $endOfMonth->format('Y-m-d');
}

function projectNameAuth()
{
    return "DR ABDUL BARI KAKAR";
}

function projectNameHeader()
{
    return "DR ABDUL BARI KAKAR";
}
function projectNameShort()
{
    return "ABK";
}

function token_number($id)
{
    // Find the current receipt
    $currentReceipt = receipt::findOrFail($id);
    
    // Get the entries for the specific date of this receipt, ordered by created_at
    $entries = receipt::whereDate('created_at', $currentReceipt->created_at)
        ->orderBy('created_at', 'asc')
        ->get();
    
    // Find the sequential number of the current entry
    $token = $entries->search(function ($entry) use ($id) {
        return $entry->id === $id;
    });
    
    // Add 1 to convert from 0-indexed to 1-indexed
    return $token !== false ? $token + 1 : null;
}

function token_date($date)
{

    // Get the entries for the specific date of this receipt, ordered by created_at
    $entries = receipt::whereDate('date', $date)
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Find the sequential number of the current entry
    $token = $entries->search(function ($entry) use ($date) {
        return $entry->date === $date;
    });
    
    // Add 1 to convert from 0-indexed to 1-indexed
    return $token !== false ? $token + 1 : null;
}

function receipt() {

    $receipt = receipt::count();

    if($receipt > 50)
    {
        return 0;
    }
    return 1;

}
