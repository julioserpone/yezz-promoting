<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonData extends Model
{
	
    protected $table = 'persons_data';
    public $primaryKey = 'id';
    public $timestamps = true;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id',
    	'identity_code',
        'first_name',
        'last_name',
        'birthdate',
        'pic_url',
        'gender',
        'language',
        'address',
    ];

    public function getBdateAttribute()
    {
        return date("d - m - Y",strtotime($this->birthdate));
    }

    public function country() {

        return $this->belongsTo(Country::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
