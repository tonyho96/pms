<?php
class HomeSettings  extends Illuminate\Database\Eloquent\Model {
	protected $table = 'homepage_setting';

	protected $fillable = ['id', 'paragraph_1', 'paragraph_2'];

	public $timestamps = false;

	protected $primaryKey = 'id';

}