<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable=['products_id','categories_id'];
    protected $table = "product_categories";
    public function Category(){
        return $this->belongsTo(Category::class,'categories_id','id');
    }
    public function Product(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}
