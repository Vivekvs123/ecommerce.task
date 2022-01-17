<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeAssoc extends Model
{
    use HasFactory;
    protected $fillable=['products_id','price','quantity','features'];
    protected $table = "product_attribute_assocs";
    public function Product(){
        return $this->belongsTo(Product::class,'products_id','id');
    }
}
