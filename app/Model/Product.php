<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
    	'sku',
    	'price'
   	];

   	/**
	 *	A product can have many categories
	 *	@return \Illuminate\Database\Eloquent\Relations\HasMAny
   	 */
    public function categories()
    {
        return $this->hasMany('App\Model\ProductCategory');
    }

}
