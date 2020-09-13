<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','date_of_birth','gender','email','password','role_id','country_id'
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
    ];

    public function country(){
        return $this->belongsTo('App\Models\Country');
    }

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }

    public function isRole(){
        return $this->role_id;
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

	public function getFullNameAttribute() {
		return ucwords($this->first_name.' '.$this->last_name);
	}

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
}
