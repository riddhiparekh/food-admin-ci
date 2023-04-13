<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent {

	protected $table = "roles"; // table name

	protected $fillable = ['role_name', 'role_slug', 'permissions'];

	public $timestamps = false;
}