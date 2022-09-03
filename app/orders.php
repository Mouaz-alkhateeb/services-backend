<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function section()
    {
    return $this->belongsTo('App\sections');
    }
    public function service()
    {
        return $this->belongsTo('App\services');
    }
    public function customer()
    {
        return $this->belongsTo('App\User');
    }
}
