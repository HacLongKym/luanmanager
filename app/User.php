<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const ROLE_ADMIN   = 1;
    const ROLE_MANAGER = 2;
    const ROLE_ORDER   = 4;
    const ROLE_CHEF    = 8;
    const ROLE_BAR     = 16;
    public $role_name  = array(
        0  => 'GUEST',
        1  => 'Admin',
        2  => 'Manager',
        4  => 'ORDER (Đặt bàn)',
        8  => 'Chef (Đầu Bếp)',
        16 => 'Bar Receptionist (Lễ Tân)',
    );
    public function role()
    {
        return $this->role_name[$this->role];
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            return $this->hasRole($roles);
        }
    }
    public function hasRole($role)
    {
        return ($this->role & $role);
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
