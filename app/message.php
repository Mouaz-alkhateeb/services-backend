<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $fillable = ['thread', 'sender_id', 'receiver_id', 'message']; 
}
