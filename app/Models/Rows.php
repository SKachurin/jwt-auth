<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rows extends Model
{
    use HasFactory;

    protected $fillable = [
        'row_id','name','date'
    ];

    public function getDateAttribute($value)
    {
//        dd($this->attributes['date']);
        return Carbon::parse($value)->format('d-m-Y');
    }

}
