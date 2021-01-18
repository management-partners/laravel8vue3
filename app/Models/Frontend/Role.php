<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Frontend\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Frontend\Permission[] $permission
 * @property-read int|null $permission_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
