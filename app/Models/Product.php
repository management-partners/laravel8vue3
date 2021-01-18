<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function cate()
    {
        return $this->belongsTo(Category::class);
    }
    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
