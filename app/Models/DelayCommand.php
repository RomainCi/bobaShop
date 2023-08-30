<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\DelayCommand
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $delay
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand query()
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereDelay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DelayCommand whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DelayCommand extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}
