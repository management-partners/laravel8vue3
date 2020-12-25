<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gallery
 *
 * @property int $id
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Gallery extends Model
{
    use HasFactory;
    protected $guarded = ['product_id'];
}