<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'staff_id'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id','id');
    }
}
