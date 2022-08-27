<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'category_id',
        'brand_id',
        'supplier_id',
        'unit_id',
        'qty',
        'unit_price',
        'sale_price',
        'total_price',
        'purchase_date',
        'expire_date',
        'status',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function supplier(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

    public function productSaleItem(){
        return $this->hasMany(ProductSaleItem::class);
    }

    public function productStock(){
        return $this->hasMany(ProductStock::class);
    }
}
