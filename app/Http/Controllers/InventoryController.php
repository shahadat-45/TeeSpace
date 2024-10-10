<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Inventory;
use App\Models\Material;
use App\Models\Product;
use App\Models\Size;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function variation(){
        $colors = Color::all();
        $size = Size::all();
        $material = Material::all();
        return view('backend.products.variation',[
            'colors' => $colors,
            'size' => $size,
            'material' => $material,
        ]);
    }
    function add_color(Request $request){
        Color::insert([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }
    function delete_color($id){
        Color::find($id)->delete();
        return back()->with('success', 'Color Deleted Successfully');

    }
    function add_size(Request $request){
        Size::insert([
            'size' => $request->size_label,
            'created_at' => Carbon::now(),
        ]);
        return redirect('/variation#size_table');
    }
    function delete_size($id){
        Size::find($id)->delete();
        return back()->with('size', 'Size Deleted Successfully');
    }

    //Inventory Section

    function inventory($id){
        $inventory = Inventory::where('product_id', $id)->get();
        $product_id = $id;
        $colors = Color::all();
        $size = Size::all();
        $material = Material::all();
        return view('backend.products.inventory', [
            "colors" => $colors,
            "size" => $size,
            "product_id" => $product_id,
            "inventory" => $inventory,
            "material" => $material,
        ]);
    }

    function add_inventory(Request $request){
        if(Inventory::where('color_id', $request->color)->where('size_id', $request->size)->where('product_id', $request->product_id)->exists()){
            Inventory::where('color_id', $request->color)->where('size_id', $request->size)->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            return back();
        }
        else{
            $request->validate([
                'color' => 'required',
                'size' => 'required',
                'price' => 'required',
                'quantity' => 'required',
            ],
            [
                'color.required' => 'Color is required',
                'size.required' => 'Size is required',
                'price.required' => 'Price is required',
                'quantity.required' => 'Quantity is required',
            ],
        );
        Inventory::insert([
                'product_id' => $request->product_id,
                'color_id' => $request->color,
                'size_id' => $request->size,
                'material_id' => $request->material,
                'price' => $request->price,
                'discount' => $request->discount,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
        }
        return back();
    }

    //Material

    function add_material(Request $request){
        $photo = $request->material_image;
        $ext = $photo->extension();
        $material_image = Str::lower(str_replace(' ', '_', $request->material_name)) . random_int(100, 999) . '.' . $ext;
        Image::make($photo)->save(public_path('backend/material/' . $material_image));
        Material::insert([
            'material_name' => $request->material_name,
            'image' => $material_image,
            'created_at' => Carbon::now(),
        ]);
        return back();
    }

    function delete_material($id){
        $material = public_path('backend/material/' . Material::find($id)->image);
        unlink($material);
        Material::find($id)->delete();
        return back()->with('material', 'Material Deleted Successfully');
    }
}
