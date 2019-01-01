<?php
class Project  extends Illuminate\Database\Eloquent\Model {
	protected $table = 'projects';

	protected $fillable = ['P-ID', 'P-Name', 'P-Description', 'P-Type', 'P-Date', 'P-Comments','USER_ID'];

	public $timestamps = false;

	protected $primaryKey = 'P-ID';

	public function units() {
		return $this->hasMany('Unit', 'U-P-ID', 'P-ID');
	}

}