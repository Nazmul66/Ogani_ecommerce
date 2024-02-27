<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_qty',
        'product_unit_prc',
        'order_id',
        'ip_address',
        'user_id',
        'size',
        'color'
    ];
}
