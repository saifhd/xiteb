<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    const VISIBLE = 0;
    const HIDDEN =1;

    protected $fillable = [
        'name',
        'image_path',
        'staff_id',
        'is_hidden'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id','id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
