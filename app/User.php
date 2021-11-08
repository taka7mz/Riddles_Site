<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

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
    
    public function riddles()
    {
        return $this->hasMany('App\Riddle');
    }

    public function getOwnPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('riddles')->find(Auth::id())->riddles()->orderBy('created_at', 'DESC')->paginate($limit_count);
    }
    
    public function getUserPaginateByLimit(int $id)
    {
        return $this::with('riddles')->find($id)->riddles()->orderBy('created_at', 'DESC')->paginate(5);
    }
}
