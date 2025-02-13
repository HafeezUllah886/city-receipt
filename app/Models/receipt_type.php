<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt_type extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function updat()
    {
        return $this->belongsTo(User::class, 'updatedBy');
    }
}
