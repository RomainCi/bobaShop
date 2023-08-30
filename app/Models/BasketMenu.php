<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\BasketMenu
 *
 * @property int $id
 * @property int $pearl_id
 * @property int $syrup_id
 * @property int $tea_id
 * @property int $menu_id
 * @property int $baskets_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereBasketsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu wherePearlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereSyrupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereTeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BasketMenu whereUpdatedAt($value)
 * @property-read \App\Models\Basket $basket
 * @property-read Collection<int, BasketSides> $basketSides
 * @property-read int|null $basket_sides_count
 * @property-read \App\Models\ProductsMenu|null $menu
 * @property-read \App\Models\ProductsPearl|null $pearl
 * @property-read \App\Models\ProductsSyrup|null $syrup
 * @property-read ProductsTea|null $tea
 * @mixin \Eloquent
 */
class BasketMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function basketSides(): HasMany
    {
        return $this->hasMany(BasketSides::class, 'basket_menus_id', 'id');
    }

    public function tea(): HasOne
    {
        return $this->hasOne(ProductsTea::class, 'id', 'tea_id');
    }

    public function menu(): HasOne
    {
        return $this->hasOne(ProductsMenu::class, 'id', 'menu_id');
    }

    public function syrup(): HasOne
    {
        return $this->hasOne(ProductsSyrup::class, 'id', 'syrup_id');
    }

    public function pearl(): HasOne
    {
        return $this->hasOne(ProductsPearl::class, 'id', 'pearl_id');
    }

    public function basket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Basket::class,'baskets_id','id');
    }

}
