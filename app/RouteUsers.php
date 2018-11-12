<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteUsers extends Model
{
    protected $table = 'route_users';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['date', 'user_id', 'route_id'];
}
