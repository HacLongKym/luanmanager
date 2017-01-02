<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
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
    protected $fillable = ['name', 'status', 'update_time'];

    
}
