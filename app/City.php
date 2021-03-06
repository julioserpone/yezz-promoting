<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	use SoftDeletes;
	
    protected $table = 'cities';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'state_id',
        'name',
    ];
}
