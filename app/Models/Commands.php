<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Commands
 *
 * @property int $id
 * @property int $users_id
 * @property int|null $perle_id
 * @property int|null $sirop_id
 * @property int|null $tea_id
 * @property int|null $menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Commands newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commands newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commands query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands wherePerleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereSiropId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereTeaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereUsersId($value)
 * @property string $status
 * @method static \Illuminate\Database\Eloquent\Builder|Commands whereStatus($value)
 * @mixin \Eloquent
 */
class Commands extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
