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
    	$product = Product::findOrFail($id);
		$product->delete();

		return response()->json($product, 200);
    }

    /*
	 * Bonus: update one or more attributes of a product at once
     */
    public function edit(ProductCreateRequest $request, $id)
    {
    	$data = $request->validated();

    	// Find product and merge request with model
    	$product = Product::findOrFail($id);
    	$product->update($data);

    	// Updating product categories by removing any category
    	// that is not in the current list to be updated
    	$categories = $product->categories()->get();
    	foreach ($categories as $category) {
    		if (!in_array($category->name, $data['category'])) {
    			$category->delete();
    		} else {
    			// Remove from the array of categories to 
    			// be updated, so we can create next
    			$key = array_search($category->name, $data['category']);
    			unset($data['category'][$key]);
    		}
    	}

    	// Creating only the categories that doesn't exist
    	foreach ($data['category'] as $name) {
    		$category = new ProductCategory();
    		$category->name = $name;
    		$product->categories()->save($category);
    	}

		return response()->json($product, 202);
    }
}
