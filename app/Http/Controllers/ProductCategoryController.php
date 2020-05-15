<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProductCategory;

class ProductCategoryController extends Controller
{
    /*
	 * Returns a list of all product categories
     */
    public function all() 
    {
    	$category = ProductCategory::all();

    	return response()->json($category, 200);
    }
}
