<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subCategory_id',
        'childCategory_id',
        'brand_id',
        'product_name',
        'product_code',
        'product_unit',
        'product_tags',
        'product_videos',
        'purchase_price',
        'selling_price',
        'discount_price',
        'quantity_stock',
        'warehouse',
        'description',
        'thumbnail',
        'images',
        'featured',
        'today_deal',
        'status',
        'flash_deal_id',
        'cash_on_delivery',
        'admin_id'
    ];
}
