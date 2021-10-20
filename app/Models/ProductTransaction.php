<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'customer_id',
        'category_id',
        'brand_id',
        'supplier_id',
        'p_qty',
        's_qty',
        'stock_qty',
        'p_unit_amount',
        's_unit_amount',
        'p_total_amount',
        's_total_amount',
        'employee_id',
        'status',
        'user_id',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brands(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function suppliers(){
        return $this->belongsTo(Suppliers::class,'supplier_id');
    }

    public function employees(){
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
