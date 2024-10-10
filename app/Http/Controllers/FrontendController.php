<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function product_detailes($slug){
        $product = Product::where('slug' , $slug)->first();
        $gallery = ProductGallery::where('product_id', $product->id)->get();
        $inventory = Inventory::where('product_id' , $product->id)->get();
        return view('TeeSpace.product_detailes' ,[
            'products' => $product,
            'inventories' => $inventory,
            'galleries' => $gallery,
        ]);
    }
}
