<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videocard extends Model
{
    protected $fillable = [
        'name',
        'score'
    ];

    public function laptops() {
        return $this->hasMany('App\Laptop');
    }
}
