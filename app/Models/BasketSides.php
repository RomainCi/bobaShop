<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\BasketSides
 *
 * @property int $id
 * @property int $basket_menus_id
 * @property int $side_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereBasketMenusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereSideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketSides whereUpdatedAt($value)
 * @property-read \App\Models\ProductsSide $side
 * @mixin \Eloquent
 */
class BasketSides extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function side():BelongsTo
    {
        return $this->belongsTo(ProductsSide::class);
    }
}
