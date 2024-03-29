<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\CategoryScope;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'status',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CategoryScope);
    }

    public function subcategory(){
        return $this->hasMany(Category::class,'parent_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function products(){
        return $this->hasOne(Product::class);
    }

    public function productTransaction(){
        return $this->hasMany(ProductTransaction::class);
    }

    public function productSaleItem(){
        return $this->hasMany(ProductSaleItem::class);
    }
}
