<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\ProductsMenu
 *
 * @property int $id
 * @property string $name
 * @property int $sides
 * @property int $size
 * @property string $price
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereSides($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsMenu withoutTrashed()
 * @mixin \Eloquent
 */
class ProductsMenu extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
}
