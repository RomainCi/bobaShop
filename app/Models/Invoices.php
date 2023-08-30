<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * App\Models\Invoices
 *
 * @property int $id
 * @property string $path
 * @property string $number
 * @property int $orders_id
 * @property int $users_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders $order
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereOrdersId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUsersId($value)
 * @mixin \Eloquent
 */
class Invoices extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class,'orders_id','id');
    }
}
