<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Relationship with users
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    // Relationship with comments
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    // Relationship with likes
    public function likes(){
        return $this->hasMany('App\Like');
    }
}
