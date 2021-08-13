<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $store_id
 * @property int $category_id
 * @property string $shop
 * @property float $qty
 * @property string $unit
 * @property string $amount
 * @property string $info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon $purchased_at
 * @property-read \App\Models\Category $category
 * @method static \Database\Factories\TransactionFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePurchasedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'info', 'amount', 'category_id',
        'shop', 'qty', 'unit', 'purchased_at'
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
    ];

    public static function ledgetTypes() {
        return ['costs', 'cash', 'income'];
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
