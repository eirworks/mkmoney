<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $fillable = [
        'name', 'type'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
