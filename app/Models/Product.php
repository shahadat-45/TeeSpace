<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function rel_to_ctg(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    function rel_to_subctg(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }
    
    function rel_to_tag(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');        
    }
    function rel_to_inventory(){
        return $this->hasMany(Inventory::class, 'product_id' , 'id');
    }
}
