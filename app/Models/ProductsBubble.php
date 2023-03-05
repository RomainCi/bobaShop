<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\ProductsBubble
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property int $stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductsBubble whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductsBubble extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

}
