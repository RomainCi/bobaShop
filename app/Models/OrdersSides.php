<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\OrdersSides
 *
 * @property int $id
 * @property int $orders_menus_id
 * @property int $side_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductsSide $side
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereOrdersMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereSideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersSides whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrdersSides extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function side()
    {
        return $this->belongsTo(ProductsSide::class, 'side_id', 'id');
    }
}
