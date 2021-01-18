<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frontend\Category;

/**
 * App\Models\Frontend\Product
 *
 * @property-read Category $cate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Frontend\Gallery[] $gallery
 * @property-read int|null $gallery_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 */
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
