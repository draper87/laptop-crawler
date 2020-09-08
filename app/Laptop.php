<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    protected $fillable= [
        'name',
        'brand',
        'ram_memory',
        'cpu_brand',
        'display_size',
        'storage_size',
        'video_card'
    ];
}
