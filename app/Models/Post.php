<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'meta_title', 'meta_description', 'title','description','image','category_id','user_id'
    ];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment')->where('parent_id',null);
    }
}
