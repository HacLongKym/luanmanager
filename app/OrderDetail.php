<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
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
    protected $fillable = ['order_id', 'sanpham_id', 'amount', 'status', 'update_at'];

    
}
