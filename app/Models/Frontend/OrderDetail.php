<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Frontend\OrderDetail
 *
 * @property-read \App\Models\Frontend\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetail query()
 * @mixin \Eloquent
 */
class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
