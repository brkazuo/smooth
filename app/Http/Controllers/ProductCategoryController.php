<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ProductCategory;

use DB;

class ProductCategoryController extends Controller
{
    /*
	 * Returns a list of all product categories
	 * Assuming that the response should return a list of distinct value of all categories
     */
    public function all() 
    {
    	$category = DB::table('product_categories')->select('name')->groupBy('name')->get();

    	return response()->json($category, 200);
    }
}
