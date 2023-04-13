<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductCategoryMap extends Eloquent {
    
    protected $table = "category_product_rel"; // table name

    protected $fillable = ['product_id','category_id'];

    public $timestamps = null;

    function category() {
        return $this->belongsTo('Category', 'category_id', 'id');
    }

    function product() {
    	return $this->belongsTo('Product', 'product_id', 'id');
    }
}