<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    public function suppliers(){
        return $this->hasMany(Suppliers::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    public function productTransaction(){
        return $this->hasMany(ProductTransaction::class);
    }

    public function productSale(){
        return $this->hasMany(ProductSale::class);
    }

    public function productSaleItem(){
        return $this->hasMany(ProductSaleItem::class);
    }

    public function unit(){
        return $this->hasMany(Unit::class);
    }

    public function productStock(){
        return $this->hasMany(ProductStock::class);
    }
}
