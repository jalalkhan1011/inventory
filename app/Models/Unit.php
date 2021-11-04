<?php

namespace App\Models;

use App\Scopes\UnitScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UnitScope);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function productSaleItem(){
        return $this->hasMany(ProductSaleItem::class);
    }
}
