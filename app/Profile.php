<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'profiles';
    public $primaryKey = 'id';
    public $timestamps = true;

   	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'code',
        'name',
        'permissions',
    ];

    public function isProfile($profiles = []) {

        return (in_array($this->code, $profiles));
    }
}
