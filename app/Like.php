<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // Table Name
    protected $table = 'likes';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Relationship with users
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    // Relationship with posts
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
