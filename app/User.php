<?php

namespace App;
use App\Status;
use App\Friend;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function friends() {
        return $this->hasMany( \App\Friend::class );
    }
    public function status() {
        return $this->hasMany( \App\Status::class );
    }
    
    public function friendsStatus() {
        return $this->hasManyThrough(
            Status::class,
            Friend::class,
            'friend_id',
            'user_id',
            'id',
            'user_id'
        );
    }
}
