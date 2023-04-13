<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Eloquent {

    protected $table = "profiles"; // table name
    protected $fillable = ['user_id','role' ,'name', 'fcm_id', 'device_company', 'device_name', 'device_code', 'last_login'];
    protected $primaryKey = 'user_id';
    use SoftDeletes;

    public function user() {
		return $this->hasOne('User', 'id', 'user_id');
	}

	public function user_role() {
		return $this->hasOne('Role', 'id', 'role');
	}
}