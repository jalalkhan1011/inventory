<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'customer_id',
        'sub_total',
        'discount',
        'grand_total',
        'total_price',
        'due',
        'change',
        'user_id'
    ];

    public function customers(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function productSaleItems(){
        return $this->hasMany(ProductSaleItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
