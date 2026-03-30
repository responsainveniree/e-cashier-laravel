<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = ["name", "price", "size", "description"];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * Single canonical stock row for list/display (oldest record when legacy data has multiple).
     */
    public function stock()
    {
        return $this->hasOne(Stock::class)->oldestOfMany();
    }
}
