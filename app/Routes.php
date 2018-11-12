<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    protected $table = 'routes';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name'];
}
