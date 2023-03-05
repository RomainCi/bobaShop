<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CommandsSides
 *
 * @property int $id
 * @property int $command_id
 * @property int $side_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides whereCommandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides whereSideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommandsSides whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CommandsSides extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
