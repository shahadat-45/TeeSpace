<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Products;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use function Laravel\Prompts\alert;

class ProductController extends Controller
{
    function product_store(){
        $categories = Category::all();
        $brands = Brand::all();
        $tags = Tag::all();
        return view('backend.products.product_store',[
            'categories' => $categories,
            'brands' => $brands,
            'tags' => $tags,
        ]);
    }
    function getsubcategory(Request $request){
        $subcategories = SubCategory::where('category_id', $request->category_id)->get();

        // $sub_cats = '';

        foreach ($subcategories as $key => $subcategory) {
            $sub_cats = '<option value="' . $subcategory->id . '">' .$subcategory->sub_category_name . '</option>';
            echo $sub_cats;
        }
    }

    function product_insert(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        // die;
        if ($request->tags == null) {
            $after_implode = null ;
        }
        else{
            $after_implode = implode(',', $request->tags);
        }
        $photo = $request->thumbnail;
        $ext = $photo->extension();
        $limit = Str::limit($request->product_name, 15, '@');
        $product_image = Str::lower(str_replace(' ', '_', $limit)) . random_int(100, 999) . '.' . $ext;
        Image::make($photo)->resize(330, 440)->save(public_path('backend/product/' . $product_image));

        $id = Product::insertGetId([
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'brand_id' => $request->brand,
            'product_name' => $request->product_name,
            'short_desp' => $request->short_desp,
            'long_desp' => $request->long_desp,
            'additional_info' => $request->additional_info,
            'tags' => $after_implode,
            'slug' => uniqid(),
            'thumbnail' => $product_image,
            'created_at' => Carbon::now(),
        ]);
        $gallery = $request->gallery;
        foreach ($gallery as $galy) {
            $ext = $galy->extension();
            $file_name = Str::lower(str_replace(' ', '_', $limit)) . random_int(100, 999) . '.' . $ext;
            Image::make($galy)->resize(555, 740)->save(public_path('backend/product/' . $file_name));

            ProductGallery::insert([
                'product_id' => $id,
                'images' => $file_name,
                'created_at' => Carbon::now(),
            ]);
        }

        return back()->with('product_added', 'Product Added Successfully');
    }

    function product_list(){
        $products = Product::latest()->get();
        $gallery = ProductGallery::all();
        return view('backend.products.product_list', [
            'products' => $products,
            'gallery' => $gallery,
        ]);
    }
    function product_view($id){
        $product = Product::find($id);
        $gallery = ProductGallery::where('product_id', $id)->get();
        return view('backend.products.product_view',[
            'product' => $product,
            'gallery' => $gallery,
        ]);
    }
    function product_delete($id){
        $product = Product::find($id);        
        $preview_img = public_path('backend/product/' . $product->thumbnail);
        unlink($preview_img);
        
        $gallery = ProductGallery::where('product_id', $id)->get();
        foreach ($gallery as $img) {
            $gallery_img = public_path('backend/product/' . $img->images);
            unlink($gallery_img);            
            ProductGallery::where('product_id', $id)->delete();
        }
        Product::find($id)->delete();
        return back()->with('deleted', 'Product deleted successfully');
    }
    function product_show(Request $request){
        $id = $request->show;
        if (Product::find($id)->product_show == 1) {
            Product::find($id)->update([
                'product_show' => 0,
            ]);
        }else{
            Product::find($id)->update([
                'product_show' => 1,
            ]);
        }
        return back();
    }
    function get_size(Request $request){
        $str = '';
        $sizes = Inventory::where('product_id', $request->product_id)->where('color_id' , $request->color)->get() ;
        foreach ($sizes as $key => $size) {
            $str .= '<li class="size_id" value="' . $size->size_id . '"><input class="size" id="s'. $key + 1 . '" type="radio" name="size" value="' . $size->size_id . '">
            <label for="s' . $key + 1  . '" > ' . $size->rel_to_size->size . '</label>
            </li>';
        }
        echo $str;
    }
    function get_material(Request $request){
        $str = '';
        $materials = Inventory::where('product_id', $request->product_id)->where('color_id' , $request->color)->where('size_id' , $request->size)->first();
        if ($materials->material_id == null) {
            $str = "<li class=" . '"mtrl"' . "><input class='material' id='" . 'mtrl' . 0 . "' type='radio' name='mtrl' value='". 0 ."'>
                        <label for='" . "mtrl" . 0 . "'><img src='" . asset('backend') . "/material/" . 'null_image.webp' . "'></label>
                    </li>";
        }
        else{
            foreach (Inventory::where('product_id', $request->product_id)->where('color_id' , $request->color)->where('size_id' , $request->size)->get() as $key => $material) {
                $str .= "<li class=" . '"mtrl"' . "><input class='material' id='" . 'mtrl' . $key + 1 . "' type='radio' name='mtrl' value='". $material->material_id ."'>
                        <label for='" . "mtrl" .  $key + 1 . "'><img src='" . asset('backend') . "/material/" . $material->rel_to_material->image . "'></label>
                    </li>";
            }
        }
        
        echo $str;
    }
    function get_price(Request $request){
        if ($request->material == 0) {
            $price = Inventory::where('product_id', $request->product_id)->where('color_id' , $request->color)->where('size_id' , $request->size)->first();            
        }
        else{
            $price = Inventory::where('product_id', $request->product_id)->where('color_id' , $request->color)->where('size_id' , $request->size)->where('material_id' , $request->material)->first();
        }
        // echo '$' . number_format($price->price , 2);
        echo $price;
    }
    function pick_color(Request $request){
        $color_name = Color::find($request->color)->color_name;
        echo $color_name;
    }
    function pick_size(Request $request){
        $size_name = Size::find($request->size)->size;
        echo $size_name;
    }
    function pick_material(Request $request){
        if ($request->material == 0) {
            $material_name = 'NONE';
        }
        else{
            $material_name = Material::find($request->material)->material_name;
        }
        echo $material_name;
    }
}
