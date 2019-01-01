<?php
class Users  extends Illuminate\Database\Eloquent\Model {
	protected $table = 'users';

	protected $fillable = ['id', 'name', 'email', 'password', 'role', 'remember_token', 'created_at', 'updated_at', 'is_working', 'is_approved', 'team'];

	public $timestamps = false;

	protected $primaryKey = 'id';

	public function project() {
		return $this->hasMany('Project', 'USER_ID', 'id');
	}
	public function item() {
			return $this->hasMany('Item', 'USER_ID', 'id');
	}
	public function template() {
		return $this->hasMany('Templates', 'USER_ID', 'id');
	}
}