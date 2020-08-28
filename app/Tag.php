<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['user_id','title'];

    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}
