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
        'cpu_name',
        'display_size',
        'storage_size',
        'videocard_name',
        'battery',
        'price',
        'image_path',
    ];

    public function videocard() {
        return $this->belongsTo('App\Videocard');
    }

    public function cpu() {
        return $this->belongsTo('App\Cpu');
    }

}
