<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branchs';
    public $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'address',
        'phone',
        'zip_code',
        'latitude',
        'longitud',
        'is_customer',
        'comments',
        'has_pop',
        'type_id',
        'chain_id',
        'country_id',
        'state_id',
        'city_id',
        'township_id',
        'category_id',
        'contact_id',
    ];

    public function type_channel()
    {
        return $this->belongsTo(TypeChannel::class, 'type_id');
    }

    public function chain()
    {
        return $this->belongsTo(Chain::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function contact()
    {
        return $this->belongsTo(BranchContact::class, 'contact_id');
    }

    public static function scopeByUserSector($query, $user)
    {
        $countries = UserSector::OnlyCountriesForUser($user)->pluck('country_id')->all();
        $states = UserSector::OnlyStatesForUser($user)->pluck('state_id')->all();
        $cities = UserSector::OnlyCitiesForUser($user)->pluck('city_id')->all();
        $townships = UserSector::OnlyTownshipsForUser($user)->pluck('township_id')->all();

        return 
            $query->where(function ($q) use ($countries, $states, $cities, $townships) {
                $q->orWhereIn('country_id', $countries)
                  ->orWhereIn('state_id', $states)
                  ->orWhereIn('city_id', $cities)
                  ->orWhereIn('township_id', $townships);
            });
    }
}
