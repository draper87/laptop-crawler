<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $fillable= [
        'laptop_id',
        'name',
        'brand',
        'ram_memory',
        'motherboard',
        'network',
        'connections',
        'cpu_brand',
        'display_size',
        'storage_size',
        'video_card',
        'battery',
        'weight'
    ];
}
