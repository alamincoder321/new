<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city_name',
        'upozila',
        'job_id',
        'join_date',
        'image',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
