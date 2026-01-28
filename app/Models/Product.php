<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = ["name", "price", "size", "quantity", "description"];

    public function stocks() {
        return $this->hasMany(Stock::class);
    }
}

