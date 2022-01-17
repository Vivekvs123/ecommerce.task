<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable=['products_id','images'];
    protected $table = "product_images";
    public function Product(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}
