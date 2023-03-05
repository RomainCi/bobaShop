<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Users_token
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Users_token query()
 * @property int $id
 * @property int $users_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
}
