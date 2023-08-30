<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Users_token
 *
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token whereUsersId($value)
 * @mixin \Eloquent
 */
class Users_token extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
       return $this->belongsTo(User::class,'users_id','id');
    }
}
