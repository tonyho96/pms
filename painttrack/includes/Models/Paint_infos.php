<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/25/2018
 * Time: 9:39 AM
 */
class Paint_infos  extends Illuminate\Database\Eloquent\Model {
    protected $table = 'paint_infos';
    public $timestamps = false;

    public function items()
    {
        return $this->hasOne('Item', 'I-PI-ID', 'PI-ID');
    }
}