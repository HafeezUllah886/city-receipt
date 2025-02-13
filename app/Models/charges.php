<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class charges extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function updat()
    {
        return $this->belongsTo(User::class, 'updatedBy');
    }

    public function type()
    {
        return $this->belongsTo(receipt_type::class, 'typeID');
    }
}
