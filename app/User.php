<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'email', 'password', 'gender', 'profile_pic', 'birthdate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationship with posts
    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    // Relationship with comments
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    // Relationship with likes
    public function likes(){
        return $this->hasMany('App\Like');
    }

    // Relationship with followers
    public function followers() 
    {
        return $this->belongsToMany(self::class, 'followers', 'follows_id', 'user_id')
                    ->withTimestamps();
    }

    // Relationship with follows
    public function follows() 
    {
        return $this->belongsToMany(self::class, 'followers', 'user_id', 'follows_id')
                    ->withTimestamps();
    }
    
    // Follow
    public function follow($userId) 
    {
        $this->follows()->attach($userId);
        return $this;
    }

    // Unfollow
    public function unfollow($userId)
    {
        $this->follows()->detach($userId);
        return $this;
    }

    //Check if following
    public function isFollowing($userId) 
    {
        return (boolean) $this->follows()->where('follows_id', $userId)->first();
    }
}
