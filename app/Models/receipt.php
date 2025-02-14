<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'time' => 'datetime',
        
    ];

    public function details()
    {
        return $this->hasMany(receipt_details::class, 'receiptID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function getEventTimeAttribute()
    {
        return $this->time->format('g:i A');
    }
    

}
