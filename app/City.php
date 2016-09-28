<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function squares() {
        return $this->hasMany('App\Square');
    }
}
