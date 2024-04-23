<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    /**
 * Product
 *
 * @property-read \App\Models\ProductField|null $fields
 * @property-read \App\Models\ProductImage|null $images
 * 
 */
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
