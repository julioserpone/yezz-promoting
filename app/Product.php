<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

	protected $table = "products";
	protected $dates = ['created_at','updated_at','delete_at'];

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'brand',
        'model',
        'name',
        'features',
        'is_yezz',
        'number_part',
    ];

    public function scopeShowDistinct($query, $field = null, $format = 'json') 
    {
    	$query->distinct();
    	if ($field) $query->select($field);
    	if ($format == 'json') return $query->ToAutocomplete($field);

    }

    public function scopeToAutocomplete($query, $field = '*') 
    {
    	$data[$field] = [];
    	foreach ($query->pluck($field) as $key => $value) {
    		$data[$field] += [$value => null];
    	}
    	return json_encode($data[$field], JSON_FORCE_OBJECT);  //imprimir un objeto JSON, no un string en formato JSON (es para javascript, control autocomplete)
    }

    public function scopeThisCompany($query)
    {
        $query->whereIn('brand', trans('globals.brands_yezz'));
    }

    public function getLabelProductionAttribute()
    {
        return trans('product.'.$this->production);
    }

    public function getArrayValuesAttribute()
    {
        //aplico una conversion implicita, porque json_decode devuelve un stdClass y la clase DefaultInputValue (propia) debe recibir es un array
        return $this->features?(array)json_decode($this->features):'';
    }

    public function getStrValuesAttribute()
    {
        $array=$this->array_values;
        return $array?implode(", ",$array):'';
    }

    public function getJsonFeaturesAttribute()
    {
        return $this->features?json_decode($this->features):[];
    }

    public static function scopeGetPhoneBrands($query) {

        return $query->select(['brand as name','is_yezz'])->distinct()->get()->toArray();
    }

    public static function scopeGetPhoneModels($query) {

        return $query->select(['brand', 'is_yezz', 'model as name', 'id as productId'])->distinct()->get()->toArray();
    }
}
