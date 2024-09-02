<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'adress',
        'phone',
        'user_id',
        'product_id'
    ];
    public function User(){
        return $this->hasOne(User::class,'id','user_id');

    }
    public function product(){
        return $this->hasOne(product::class,'id','product_id');

    }
}
