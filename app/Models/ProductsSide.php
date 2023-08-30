<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\ProductsSide
 *
 * @property int $id
 * @property string $name
 * @property string|null $flavor
 * @property string $description
 * @property string $price
 * @property string $currency
 * @property int $quantity
 * @property string $image_url
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereFlavor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsSide withoutTrashed()
 * @mixin \Eloquent
 */
class ProductsSide extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
}
