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
        'weight',
        'price',
        'image_path',
    ];

    // dichiaro la foreign key in quanto non ho creato la colonna "id" per la tabella videocards
    public function videocard() {
        return $this->belongsTo(Videocard::class, 'videocard_name', 'name');
    }
    // dichiaro la foreign key in quanto non ho creato la colonna "id" per la tabella cpus
    public function cpu() {
        return $this->belongsTo(Cpu::class, 'cpu_name', 'name');
    }

}
