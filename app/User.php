<?php

namespace App;

use Illuminate\Support\Str;
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
        'username' ,'name', 'email', 'password', 'avatar'
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

    //Mutator
    public function setPasswordAttribute($value) {
        
        $this->attributes['password'] = bcrypt($value);

     }

    public function posts () {

        return $this->hasMany(Post::class);
    }

    public function permissions () {
        return $this->belongsToMany(Permission::class);
    }

    public function roles () {
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($inquiredRole) {
        foreach($this->roles as $role) {

            return (bool)(Str::lower($inquiredRole) === Str::lower($role->name));
            
        }
    }
    public function getAvatarAttribute($value){
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
     
        return asset('storage/' . $value);
    }
        


}
