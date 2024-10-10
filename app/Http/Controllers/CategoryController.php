<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function category(){
        $categories = Category::all();
        return view('backend.category.category' , [
            'categories' => $categories,
        ]);
    }
    function category_store(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);
        $slug = Str::replace(' ', '_', $request->name) . uniqid();
        $photo = $request->image;
        $ext = $photo->extension();
        $file_name = $request->name . '.' . $ext;
        Image::make($photo)->save(public_path('backend/category/'. $file_name));
        Category::insert([
            'category_name' => $request->name,
            'category_image' => $file_name,
            'slug' => $slug,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success' , 'Category Added Successfully');
    }
    function category_delete($id){
        Category::find($id)->delete();
        return back()->with('deleted', 'Category item deleted successfully');
    }
}
