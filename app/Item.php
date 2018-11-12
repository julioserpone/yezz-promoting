<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $table = 'items';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'branch_id',
        'product_id',
        'purchase_price',
        'sale_price',
        'stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

	public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
