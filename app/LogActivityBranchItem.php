<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivityBranchItem extends Model
{
    protected $table="logs_activity_branch_items";
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log_activity_id',
        'product_id',
        'product_id_reference',
        'product_features',
        'stock',
        'exhibition',
        'sales',
        'purchase_price',
        'sale_price',
        'old_item_id',
    ];

    public function log_activity()
    {
        return $this->belongsTo(LogActivityBranch::class, 'log_activity_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function competence()
    {
        return $this->belongsTo(Product::class,'product_id_reference');
    }

    public function getJsonFeaturesAttribute()
    {
    	return json_decode($this->product_features?$this->product_features:[]);
    }
}
