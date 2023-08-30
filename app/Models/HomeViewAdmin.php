<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\HomeViewAdmin
 *
 * @property int $id
 * @property string $content
 * @property int $usersAdmin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HomeViewAdmin whereUsersAdminId($value)
 * @mixin \Eloquent
 */
class HomeViewAdmin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
