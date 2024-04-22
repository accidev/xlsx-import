<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductField extends Model
{
    protected $table = 'product_fields';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'key',
        'value',
    ];
}
