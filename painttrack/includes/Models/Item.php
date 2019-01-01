<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2/25/2018
 * Time: 9:38 AM
 */
class Item  extends Illuminate\Database\Eloquent\Model {
    protected $table = 'items';

    protected $fillable = ['I-ID', 'I-Name', 'I-Description', 'P-Type', 'P-Date', 'P-Comments'];

    public $timestamps = false;


}
?>