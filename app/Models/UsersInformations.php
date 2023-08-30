<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersInformations
 *
 * @property int $id
 * @property int $users_id
 * @property string $street
 * @property string $country
 * @property string $postal_code
 * @property string $city
 * @property string|null $society
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereSociety($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations whereUsersId($value)
 * @mixin \Eloquent
 */
class UsersInformations extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
