<?php

class Paint_infos  extends Illuminate\Database\Eloquent\Model {
    protected $table = 'paint_infos';

    protected $fillable = ['PI-ID', 'PI-PaintName', 'PI-Color', 'PI-Type', 'PI-Manufacturer', 'PI-PaintID', 'PI-Picture1', 'PI-Picture2', 'PI-Picture3', 'PI-Picture4', 'PI-Quant-Buy', 'PI-Quant-Used', 'PI-Quant-Remain', 'PI-Cost', 'PI-Unit', 'PI-PaintComments' ];

    public $timestamps = false;

    protected $primaryKey = 'PI-ID';

    public function items()
    {
        return $this->hasOne('Item', 'I-PI-ID', 'PI-ID');
    }
}

 ?>
