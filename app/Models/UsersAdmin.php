<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\UsersAdmin
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersAdmin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UsersAdmin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected string $guard = 'admin';

    protected $fillable = [
        'email', 'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

}

