<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Store
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $image
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Collection $settings
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $type_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeRecord[] $incomeRecords
 * @property-read int|null $income_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\StoreFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Store newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Store query()
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereSettings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Store whereUserId($value)
 * @mixin \Eloquent
 */
class Store extends Model
{
    use HasFactory;

    const TYPE_SHOP = "shop";
    const TYPE_CAFE = "cafe";
    const TYPE_RESTAURANT = "restaurant";

    public static function types()
    {
        return [
            self::TYPE_SHOP => "Toko",
            self::TYPE_CAFE => "Kafe",
            self::TYPE_RESTAURANT => "Restoran"
        ];
    }

    public function getTypeNameAttribute()
    {
        return self::types()[$this->type] ?? "?";
    }

    protected $fillable = [
        'name', 'type', 'phone', 'email', 'address'
    ];

    protected $casts = [
        'settings' => 'collection'
    ];

    protected $appends = [
        'type_name'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function incomeRecords()
    {
        return $this->hasMany(IncomeRecord::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
