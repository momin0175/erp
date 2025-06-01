<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production_product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_name',
        'thikness',
        'gsm',
        'weight',
        'dia',
        'size',
        'proter_sort',
        'qty',
        'production_date',
        'shift',
    ];
}
