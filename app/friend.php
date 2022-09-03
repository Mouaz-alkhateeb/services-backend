<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friend extends Model
{
    protected $fillable = ['user', 'friend'];


    public function user()
    {
        return $this->belongsTo('App\User', 'friend', 'id');
    }
}
