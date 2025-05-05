<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 
        'product_code', 
        'description',
        'price',
        'stock',
        'image',
        'discount_price',
        'is_active',
    ];
}
