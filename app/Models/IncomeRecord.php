<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IncomeRecord
 *
 * @property int $id
 * @property int $store_id
 * @property \Illuminate\Support\Carbon $date
 * @property string $amount
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\IncomeRecordFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeRecord whereUserId($value)
 * @mixin \Eloquent
 */
class IncomeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id', 'date', 'amount', 'name'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
