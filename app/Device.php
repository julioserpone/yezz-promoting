<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table="devices";
    public $primaryKey = 'id';
    public $translatedAttributes = ['name'];
    protected $fillable = ['code','description','type','name'];

    public function getArrayValuesAttribute()
    {
        return $this->description?json_decode($this->description):'';
    }

    public function getStrValuesAttribute()
    {
    	$array=$this->array_values;
        return $array?implode(", ",$array):'';
    }
}
//Used for Translations
class DeviceTranslation extends Model {

    protected $table="devices_translations";
    public $timestamps = false;
    protected $fillable = ['name'];

}
