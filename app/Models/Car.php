<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'model',
        'color',
        'year',
        'doors',
        'mileage',
        'daily_rate'
    ];

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function leaseRequests()
    {
        return $this->hasMany(LeaseRequest::class);
    }
}
