<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'shop_name',
        'address',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->hasMany(Product::class);
}
}
