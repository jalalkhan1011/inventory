<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'trans_id',
        'description',
        'product_sale_id',
        'access_user',
        'access_user_id',
        'customer_id',
        'amount',
        'product_status',
        'status',
        'user_id'
    ];

    public function productSale(){
        return $this->belongsTo(ProductSale::class,'product_sale_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
