<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
use Notifiable;
use HasRoles;
/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
    'name', 'email', 'password','roles_name','status','provider_id','avatar'
    ];
    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
    'password', 'remember_token',
    ];
    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
    'email_verified_at' => 'datetime',
    'roles_name'=>'array',
    
    ];
    public function friends()
    {
        return $this->hasOne('App\Friend', 'friend', 'id');
    }
    public function services()
    {
        return $this->hasMany('services');
    }
    public function orders()
    {
        return $this->hasMany('orders');
    }
    }