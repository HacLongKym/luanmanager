<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    const ROLE_ADMIN = 1;
    const ROLE_MANAGER = 2;
    const ROLE_USER = 4;
    // public function roles()
    // {
    //     return $this->belongsToMany('App\Role', 'user_role', 'user_id', 'role_id');
    // }
    public function hasAnyRole($roles) {
        if (is_array($roles)) {
            foreach ($roles as  $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            return $this->hasRole($roles);
        }
    }
    public function hasRole($role) {
        return ($this->roles & $role);
    }
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
}
