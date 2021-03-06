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
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $post_code
 * @property string $address
 * @property string $tel
 * @property string $mobile
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePostCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
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
