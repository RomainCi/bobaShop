<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Orders
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders query()
 * @property int $id
 * @property int $users_id
 * @property string $status
 * @property string $total_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersMenu> $ordersMenu
 * @property-read int|null $orders_menu_count
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUsersId($value)
 * @property-read \App\Models\Invoices|null $invoice
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdersMenu> $ordersMenu
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Orders extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ordersMenu(): HasMany
    {
       return $this->hasMany(OrdersMenu::class, 'orders_id', 'id');
    }

    public function invoice() : HasOne
    {
        return $this->hasOne(Invoices::class,'orders_id','id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
