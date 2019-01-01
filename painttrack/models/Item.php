<?php

class Item  extends Illuminate\Database\Eloquent\Model {
    protected $table = 'items';

    protected $fillable = ['I-ID', 'I-Name', 'I-Description', 'I-R-ID', 'I-PI-ID', 'I-Comment','USER_ID'];

    public $timestamps = false;

    protected $primaryKey = 'I-ID';

    public function room(){
      return $this->belongsTo('Room', 'I-R-ID', 'R-ID');
    }

    public function paintinfos(){
      return $this->belongsTo('paint_infos', 'I-PI-ID', 'PI-ID');
    }
}

 ?>
