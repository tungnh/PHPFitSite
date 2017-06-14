<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';
    
    /**
     * The model not using timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
}
