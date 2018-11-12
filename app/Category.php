<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'description','status'];
}
