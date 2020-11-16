<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpu extends Model
{
    protected $fillable = [
        'name',
        'score',
        'cores',
    ];

    public function laptops() {
        return $this->hasMany('App\Laptop');
    }
}
