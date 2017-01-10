<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    const OPEN = 0;
    const CLOSE = 1;
    /**
     * Set default for column
     */
    protected $defaults = array(
       'status' => 0,
    );
    /**
     * Override __construct to set default value for column
     */
    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes($this->defaults, true);
        parent::__construct($attributes);
    }
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'luan_ban';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status', 'update_at'];

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
