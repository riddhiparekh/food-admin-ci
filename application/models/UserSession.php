<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class UserSession extends Eloquent {

	protected $table = "user_sessions";

	public $timestamps= null;
}