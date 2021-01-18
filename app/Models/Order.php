<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
