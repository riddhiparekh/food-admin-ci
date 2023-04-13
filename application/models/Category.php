<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Eloquent {
	
	use SoftDeletes;    
	protected $table = "categories"; // table name
    
    protected $fillable = ['name', 'sub_title', 'is_active', 'parent_id' ,'description', 'image'];
	
	function getImageAttribute($value)
	{
		return ASSET_URL.'images/category/'.$value;
	}

	function productMapped() {
		return $this->hasMany('ProductCategoryMap', 'category_id', 'id');
	}

	function products() {
		return $this->belongsToMany('Product', 'category_product_rel');
	}

	function scopeParent($query) {
		return $query->whereNull('parent_id');
	}

	function scopeChildren($query) {
		return $query->whereNotNull('parent_id');
	}
}