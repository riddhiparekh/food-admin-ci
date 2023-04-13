<?php 
use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Eloquent {

    use SoftDeletes;

	protected $table = "coupons"; // table name
    
    protected $fillable = [
        'title', 
        'code', 
        'description', 
        'amount' ,'amount_type', 
        'valid_from', 
        'valid_till', 
        'max_orders', 
        'min_orders', 
        'min_order_value', 
        'max_order_value'
    ];

    function setValidFromAttribute($value)
    {
        $this->attributes['valid_from'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }
    function setValidTillAttribute($value)
    {
        $this->attributes['valid_till'] = \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }
    function getValidFromAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d',$value)->format('d-m-Y');
    }
    function getValidTillAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d',$value)->format('d-m-Y');
    }

    function scopeValid($query) {
        $now = \Carbon\Carbon::now();
        return $query->where('valid_from', '<=', $now)->where('valid_till', '>=', $now);
    }
}