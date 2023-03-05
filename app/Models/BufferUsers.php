<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\BufferUsers
 *
 * @property int $id
 * @property string $token
 * @property string $lastname
 * @property string $firstname
 * @property string $phone
 * @property string $email
 * @property string $birthdays
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers query()
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BufferUsers whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BufferUsers extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


}
