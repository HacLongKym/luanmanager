<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    const WAIT = 0;
    const DONE = 1;
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

    public function name() {
        return \App\Product::find($this->sanpham_id)->name;
    }
    public function product() {
        return $this->belongsTo('App\Product', 'sanpham_id');
    }
    public function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }
    protected $table = 'luan_order_deltail';

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
    protected $fillable = ['order_id', 'ban_id', 'sanpham_id', 'amount', 'status', 'price_each', 'user_id_create', 'user_id_update', 'update_at'];


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
        $attributes['user_id_create'] = \Auth::user()->id;
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
        $this->user_id_update = \Auth::user()->id;
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
        $attributes['user_id_update'] = \Auth::user()->id;
        parent::update($attributes, $options);
    }

    /**
     * ==============================================
     * End Override
     * ==============================================
     */
}
