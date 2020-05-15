<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name'
   	];

   	/**
	 *	A productCategory is always owned by a product
	 *
	 *	@return \Illuminate\Database\Eloquent\Relations\BelongsTo
   	 */
    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
