<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeChannel extends Model
{
    use \Dimsav\Translatable\Translatable;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'type_channels';
    public $primaryKey = 'id';
    public $timestamps = true;

    public $translatedAttributes = ['name'];
    protected $fillable = ['code', 'name'];
}


//Used for Translations
class TypeChannelTranslation extends Model {

    public $timestamps = false;
    protected $fillable = ['name'];

}