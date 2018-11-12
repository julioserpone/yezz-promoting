<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSector extends Model
{
    protected $table = 'user_sectors';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'country_id',
        'state_id',
        'city_id',
        'township_id',
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function country() {

    	return $this->belongsTo(Country::class);
    }

    public function state() {

    	return $this->belongsTo(State::class);
    }

    public function city() {

    	return $this->belongsTo(City::class);
    }

    public function township() {

    	return $this->belongsTo(Township::class);
    }

    /**
     * Get countries
     * @param  Object  $query   QueryBuiler
     * @param  User    $user    User collection
     * @return Object           QueryBuilder
     */
    public static function scopeOnlyCountriesForUser($query, $user)
    {
        $query->where('user_id', $user->id)
            ->whereNull('state_id')
            ->whereNull('city_id')
            ->whereNull('township_id')
            ->get(['country_id as id']);
    }

    /**
     * Get States
     * @param  Object  $query   QueryBuiler
     * @param  User    $user    User collection
     * @return Object           QueryBuilder
     */
    public static function scopeOnlyStatesForUser($query, $user)
    {
        $query->where('user_id', $user->id)
            ->whereNotNull('state_id')
            ->whereNull('city_id')
            ->whereNull('township_id')
            ->get(['state_id as id']);
    }

    /**
     * Get cities
     * @param  Object  $query   QueryBuiler
     * @param  User    $user    User collection
     * @return Object           QueryBuilder
     */
    public static function scopeOnlyCitiesForUser($query, $user)
    {
        $query->where('user_id', $user->id)
            ->whereNotNull('city_id')
            ->whereNull('township_id')
            ->get(['city_id as id']);
    }

    /**
     * Get townships
     * @param  Object  $query   QueryBuiler
     * @param  User    $user    User collection
     * @return Object           QueryBuilder
     */
    public static function scopeOnlyTownshipsForUser($query, $user)
    {
        $query->where('user_id', $user->id)
            ->whereNotNull('township_id')
            ->get(['township_id as id']);
    }
}
