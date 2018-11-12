<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $table = 'townships';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'city_id',
        'name',
    ];

    public function city() {

    	return $this->belongsTo(City::class);
    }
}
