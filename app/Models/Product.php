<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['pname'];
    protected $table = "products";
    public function ProductImage(){
        return $this->hasMany(ProductImage::class,'products_id','id');
    }
    public function ProductAttributeAssoc(){
        return $this->hasOne(ProductAttributeAssoc::class,'products_id','id');
    }
    public function ProductCategory(){
        return $this->hasOne(ProductCategory::class,'products_id','id');
    }
    public function Category(){
        return $this->belongsToMany(Category::class,'product_categories','products_id','categories_id');
    }
}
