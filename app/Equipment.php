<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{

	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'equipments';

    public function type() {
        return $this->hasOne('App\EquipmentType', 'id', 'equipment_type_id');
    }

    public function squares() {
        return $this->belongsToMany('App\Square');
    }

}
