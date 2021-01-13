<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Permision
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Permision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permision query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 */
class Permission extends Model
{
    use HasFactory;
}
