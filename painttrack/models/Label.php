<?php

class Label extends Illuminate\Database\Eloquent\Model {
	protected $table = 'labels';

	protected $fillable = ['L-ID', 'L-Name', 'L-I-ID', 'L-Image-Pos', 'L-Comment'];

	public $timestamps = false;

	protected $primaryKey = 'L-ID';

	public function item(){
		return $this->belongsTo('Item', 'L-I-ID', 'I-ID');
	}
}