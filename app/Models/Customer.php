<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'address',
        'zip_code',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function productSale(){
        return $this->hasMany(ProductSale::class);
    }

    public function productSaleItem(){
        return $this->hasMany(ProductSaleItem::class);
    }

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
