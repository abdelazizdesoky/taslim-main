<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    } 
}
