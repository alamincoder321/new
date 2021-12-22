<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'city_name',
        'upozila',
        'status'
    ];


    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function due()
    {
        return $this->hasMany(Due::class);
    }
}
