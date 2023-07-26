<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersInformations
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsersInformations query()
 * @mixin \Eloquent
 */
class UsersInformations extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
