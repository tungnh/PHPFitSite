<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';
    
    /**
     * The model not using timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;
    
    /**
     * Mapping has one menus table, with foreign key (menu_id) references menus(id)
     *
     * @return Manager infomation of Department
     */
    public function menu_parent()
    {
        return $this->hasOne(Menu::class, 'id', 'id_parent');
    }
}
