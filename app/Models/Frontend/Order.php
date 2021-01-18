<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Frontend\Order
 *
 * @property-read mixed $name
 * @property-read mixed $total
 * @property-read mixed $total_quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Frontend\OrderDetail[] $orderDetail
 * @property-read int|null $order_detail_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function getTotalAttribute()
    {
        return $this->orderDetail->sum(function (OrderDetail $item) {
            return $item->price * $item->quantity;
        });
    }
    public function getTotalQuantityAttribute()
    {
        return $this->orderDetail->sum(function (OrderDetail $item) {
            return $item->quantity;
        });
    }
    public function getNameAttribute()
    {
        return $this->first_name . ' '. $this->last_name;
    }
}