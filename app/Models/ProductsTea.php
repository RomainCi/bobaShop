<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\ProductsTea
 *
 * @property int $id
 * @property string $name
 * @property string $image_url
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsTea withoutTrashed()
 * @mixin \Eloquent
 */
class ProductsTea extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
}
