<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    const HIDDEN = 1;
    const VISIBLE = 0;

    protected $fillable = [
        'name',
        'image_path',
        'staff_id',
        'category_id',
        'is_hidden'
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class,'staff_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'sub_category_id', 'id');
    }
}
