<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Eloquent {
	
	use SoftDeletes;
	protected $table = "products"; // table name
	
	// protected $dates = ['created_at', 'updated_at'];
	
	protected $fillable = ['name','images','sub_title','price','description','is_active'];

	protected $casts = [
		'images' => 'array'
	];
	protected $primaryKey = 'id';

	function getPriceAttribute($value)
	{
		return floatval($value);
	}

	function categories() {
		return $this->hasMany('ProductCategoryMap', 'product_id');
	}

}