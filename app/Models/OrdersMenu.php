<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\OrdersMenu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu query()
 * @property int $id
 * @property int $pearl_id
 * @property int $syrup_id
 * @property int $tea_id
 * @property int $menu_id
 * @property int $orders_id
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductsMenu $menus
 * @property-read \App\Models\ProductsPearl $pearls
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersSides> $sides
 * @property-read int|null $sides_count
 * @property-read \App\Models\ProductsSyrup $syrups
 * @property-read \App\Models\ProductsTea $teas
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereOrdersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu wherePearlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereSyrupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereTeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdersMenu whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersSides> $sides
 * @mixin \Eloquent
 */
class OrdersMenu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function menus(): BelongsTo
    {
        return $this->belongsTo(ProductsMenu::class,'menu_id','id');
    }

    public function teas():BelongsTo
    {
        return $this->belongsTo(ProductsTea::class,'tea_id','id');
    }

    public function pearls():BelongsTo
    {
        return $this->belongsTo(ProductsPearl::class,'pearl_id','id');
    }

    public function syrups():BelongsTo
    {
        return $this->belongsTo(ProductsSyrup::class,'syrup_id','id');
    }

    public function sides():HasMany
    {
        return $this->hasMany(OrdersSides::class,'orders_menus_id','id');
    }
}
