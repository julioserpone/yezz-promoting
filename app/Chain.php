<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chain extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chain_user_id',
        'chain_country_id',
        'identification_chain',
        'name_chain',
        'phone_chain',
        'email_chain', 
        'address_chain',
    ];

    public function user() {

        return $this->belongsTo(User::class, 'chain_user_id');
    }

    public function country() {

        return $this->belongsTo(Country::class, 'chain_country_id');
    }
}
