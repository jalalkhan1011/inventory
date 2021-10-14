<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSaleItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id' ,
        'customer_id',
        'category_id',
        'brand_id',
        'stock_qty',
        'sale_qty',
        'sale_price',
        'total_item_price',
        'product_sale_id',
        'user_id'
    ];

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function productSales(){
        return $this->belongsTo(ProductSale::class,'product_sale_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
