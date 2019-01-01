<?php
class Unit  extends Illuminate\Database\Eloquent\Model {
	protected $table = 'units';

	protected $fillable = ['U-ID', 'U-Name', 'U-Description', 'U-Comments', 'U-P-ID'];

	public $timestamps = false;

	protected $primaryKey = 'U-ID';

	public function project() {
		return $this->belongsTo('Project', 'U-P-ID', 'P-ID');
	}

	public function rooms() {
		return $this->hasMany('Room', 'R-U-ID', 'U-ID');
	}
}