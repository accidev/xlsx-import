<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'external_code',
        'name',
        'description',
        'price',
        'discount',
    ];

    public function fields(){
        return $this->hasMany(ProductField::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
