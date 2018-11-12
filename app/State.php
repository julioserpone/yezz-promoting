<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    
    protected $table = 'states';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'country_id',
        'name',
    ];

    public function country() {

    	return $this->belongsTo(Country::class);
    }
}
