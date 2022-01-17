<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','description'];
    protected $table = "categories";
    // public function ProductCategory(){
    //     return $this->hasOne(ProductCategory::class,'categories_id','id');
    // }
    public function Product(){
        return $this->belongsToMany(Product::class,'product_categories','categories_id','products_id');
    }
}
