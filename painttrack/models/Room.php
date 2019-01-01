<?php
class Room  extends Illuminate\Database\Eloquent\Model {
	protected $table = 'rooms';

	protected $fillable = ['R-ID', 'R-Name', 'R-Description', 'R-Comments', 'R-U-ID'];

	public $timestamps = false;

	protected $primaryKey = 'R-ID';

	public function unit() {
		return $this->belongsTo('Unit', 'R-U-ID', 'U-ID');
	}

	public function items() {
		return $this->hasMany('Item', 'I-R-ID', 'R-ID');
	}

}