<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnh',
        'birthdate',
        'address_line1',
        'address_line2',
        'address_line3'
    ];

    public function documents()
    {
        return $this->hasMany(ClientDocumentImage::class);
    }

    public function leaseRequest()
    {
        return $this->hasMany(LeaseRequest::class);
    }
}
