<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    Use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
