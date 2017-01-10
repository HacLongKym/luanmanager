<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * Set default for column
     */
    protected $defaults = array(
       'role' => 0,
    );
    /**
     * Override __construct to set default value for column
     */
    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes($this->defaults, true);
        parent::__construct($attributes);
    }
    
    use Notifiable;
    const ROLE_GUEST   = 0;
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

    
    /**
     * ==============================================
     * Override to write actor and log
     * ==============================================
     */

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function create(array $attributes = []) {
        parent::create($attributes);
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = []) {
        // var_dump(\Auth::user()->role);die;
        parent::save($options);
    }

    /**
     * Delete the model from the database.
     *
     * @return bool|null
     *
     * @throws \Exception
     */
    public function delete()
    {
        parent::delete();
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        parent::update($attributes, $options);
    }

    /**
     * ==============================================
     * End Override
     * ==============================================
     */
}
