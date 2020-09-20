<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cpu extends Model
{
    protected $fillable = [
        'name',
        'score'
    ];

    public function laptops() {
        return $this->hasMany('App\Laptop');
    }
}
