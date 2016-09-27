<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function square() {
        return $this->belongsTo('App\Square');
    }
}
