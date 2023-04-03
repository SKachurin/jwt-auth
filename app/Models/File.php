<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    protected $appends = ['full_path'];
    protected $guarded = ['id'];

    public function getFullPathAttribute(){
        if(Storage::disk('upload')->exists($this->name)) {
            return Storage::disk('upload')->url($this->name);
        }else{
            return false;
        }
    }
}
