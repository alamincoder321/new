<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone1',
        'phone2',
        'status'
    ];


    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function duesupplier()
    {
        return $this->hasMany(DueSupplier::class);
    }
}
