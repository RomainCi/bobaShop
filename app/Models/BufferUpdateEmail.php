<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BufferUpdateEmail
 *
 * @property int $id
 * @property int $users_id
 * @property string $email
 * @property string|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail query()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUpdateEmail whereUsersId($value)
 * @mixin \Eloquent
 */
class BufferUpdateEmail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
