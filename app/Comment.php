<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Table Name
    protected $table = 'comments';
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
