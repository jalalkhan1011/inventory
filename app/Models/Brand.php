<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\BrandScope;
class Brand extends Model
{
    use HasFactory;
    Use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BrandScope);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->hasOne(Product::class);
    }
}
