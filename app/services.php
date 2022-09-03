<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $fillable = ['name', 'description', 'section_id', 'status', 'Value_status', 'service_provider_id'];

    public function section()
    {
        return $this->belongsTo('App\sections');
    }
    public function provider()
    {
        return $this->hasOne('App\User', 'id', 'service_provider_id');
    }
    public function order()
    {
        return $this->hasMany('App\orders');
    }
}
