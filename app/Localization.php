<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'localization_log';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['user_id', 'store_id','longitude', 'latitude', 'registerOn'];
}
