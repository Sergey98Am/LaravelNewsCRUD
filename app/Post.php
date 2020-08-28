<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','meta_title', 'meta_description', 'title','description','images','tags','category_id'
    ];

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}
