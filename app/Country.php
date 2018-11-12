<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    
    protected $table = 'countries';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'sortname',
        'name',
    ];

    public function states() {

    	return $this->hasMany(State::class);
    }
}
