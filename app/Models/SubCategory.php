<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'staff_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id','id');
    }
}
