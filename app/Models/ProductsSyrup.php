<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductsSyrup
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup query()
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSyrup withoutTrashed()
 * @mixin \Eloquent
 */
class ProductsSyrup extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
}
