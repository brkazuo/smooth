<?php

use Illuminate\Database\Seeder;

use App\Model\Product;
use App\Model\ProductCategory;

class SpicyDeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
        	[
	            "name" => "Sik Sik Wat", 
	            "category" => [
	            	"Ethiopia",
	            	"Meat",
	            	"Beef",
	            	"Chili pepper"
	            ], 
	            "sku" => "DISH999ABCD", 
	            "price" => 13.49 
         	], 
         	[
				"name" => "Huo Guo", 
				"category" => [
					"China", 
					"Meat", 
					"Beef", 
					"Fish", 
					"Tofu", 
					"Sichuan pepper"
				], 
				"sku" => "DISH234ZFDR", 
				"price" => 11.99 
            ], 
         	[
				"name" => "Cau-Cau", 
				"category" => [
					"Peru",
					"Potato",
					"Yellow Chili pepper"
				], 
				"sku" => "DISH775TGHY", 
				"price" => 15.29 
            ] 
        ];
    
        foreach ($seeds as $seed) {
 			$categories = $seed['category'];
 			unset($seed['category']);

        	$product = new Product($seed);
        	$product->save();


        	foreach ($categories as $name) {
        		$category = new ProductCategory;
        		$category->name = $name;
        		$product->categories()->save($category);
        	}
        }
    }
}