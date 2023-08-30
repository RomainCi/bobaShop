<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\ProductsPearl
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsPearl withoutTrashed()
 * @mixin \Eloquent
 */
class ProductsPearl extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
}
