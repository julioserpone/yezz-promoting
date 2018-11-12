<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteDetails extends Model
{
    protected $table = 'route_details';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['route_id', 'branch_id'];
}
