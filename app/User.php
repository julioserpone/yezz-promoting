<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'person_id',
        'profile_id',
        'country_id',
        'username',
        'status',
        'email', 
        'password',
        'temp_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','temp_password',
    ];

    public function person()
    {
        return $this->belongsTo(PersonData::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function contact()
    {
        return $this->hasMany(ContactData::class, 'source_id');
    }

    public static function create(array $attr = []) {
        if (isset($attr['person'])) {
            $person = PersonData::create($attr['person']);
            $attr['person_id'] = $person->id;
            unset($attr['person']);
        }

        //version laravel 5.3
        //return parent::create($attr);

        //Version laravel 5.4
        $model = static::query()->create($attr);
        return $model;
    }

    public function getFullNameAttribute()
    {
        $user = $this->person()->first();
        return ucfirst($user->first_name).' '.ucfirst($user->last_name);
    }

    public function canDelete() 
    {   
        return in_array($this->profile->code, ['administrator']);
    }

    public function sectors() {

        return $this->hasMany(UserSector::class);
    }
}
