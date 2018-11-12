<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivityBranch extends Model
{
    protected $table="logs_activity_branch";
    protected $dates = ['entry_time','departure_time'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'user_id',
        'branch_id',
    	'comment',
        'entry_time',
        'departure_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function items()
    {
        return $this->hasMany(LogActivityBranchItem::class, 'log_activity_id');
    }

    public function photo_evidences() 
    {
        return $this->hasMany(MediaFile::class, 'source_id')->where('origin', 'storePhotoEvidence');
    }
}
