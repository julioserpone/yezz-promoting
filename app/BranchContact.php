<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchContact extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
    	'name_customer',
    	'surname_customer', 
    	'store_position_customer', 
    	'phone_customer', 
    	'email_customer', 
    	'address_customer'
    ];
}
