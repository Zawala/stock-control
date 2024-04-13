<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'quantity',
        'price',
        'description'
    ];
    public function getRouteKeyName()
{
    return 'code'; // Assuming 'code' is the column that contains the product identifier
}
}
