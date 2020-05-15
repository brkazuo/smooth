<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductCategory;
use Response;

class ProductController extends Controller
{
    /*
	 * Returns a list of all products or a single product if ID is specified
     */
    public function list($id = null) 
    {
    	if ($id) {
    		$result = Product::where('id', $id)->with('categories')->first();
    	} else {
    		$result = Product::with('categories')->get();
    	}

    	return response()->json($result, 200);
    }

    /*
	 * Creates a new product
     */
    public function create(ProductCreateRequest $request) 
    {
    	$data = $request->validated();

    	$product = new Product($data);
    	$product->save();

    	// Saving categories
    	foreach ($data['category'] as $name) {
    		$product_category = new ProductCategory();
    		$product_category->name = $name;
    		$product->categories()->save($product_category);
    	}

    	return response()->json($product, 201);

    }

    /*
	 * Deletes a product by ID
     */
    public function delete($id)
    {
    	$product = Product::find($id);
    	if (!$product) {
    		abort(404, "Product not found");
    	}

		$product->delete();
		return response()->json($product, 200);
    }

}
