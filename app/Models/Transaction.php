<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'info', 'amount', 'category_id',
        'shop', 'qty', 'unit', 'purchased_at'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
