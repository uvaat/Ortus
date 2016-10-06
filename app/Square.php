<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Square extends Model
{

	use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function city() {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function equipments() {
        return $this->belongsToMany('App\Equipment', 'equipments_squares', 'square_id', 'equipment_id');
    }

}
