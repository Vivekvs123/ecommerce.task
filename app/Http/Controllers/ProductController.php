<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttributeAssoc;
use App\Models\ProductCategory;
use App\Models\ProductImage;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(2);
        $images = ProductImage::with('Product')->get();
        // $attributes = ProductAttributeAssoc::with('Product')->get();
        // $categories = ProductCategory::with('Category','Product')->get();
        // $images = ProductImage::with('Product')->get();

        return view('admin.pages.showproduct',compact('products','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catdata=Category::all();
        return view('admin.pages.addproduct',compact('catdata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate=$req->validate([
            'pname'=>'required|min:2',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
            'features'=>'required|min:6|max:255',
            'file'=>'required',
         
        ]);
        if($validate){
            $image=array();
            $imageextension=['jpeg','png','gif','jpg'];
            $files=$req->file('file');
            if( $files && $imageextension){
                // foreach($files as $file)
                // {
                //     $dest='public/uploads/';
                //     $filename="Image-".rand()."-".time().".".$file->extension();
                //     $image_url=$dest.$filename;
                //     $file->move($dest,$filename);
                //     $image[]=$image_url;
                // }
                $product=Product::create([
                    'pname'=>$req->pname,
                ]);
                if($product){
                    $pid=$product->id;
                    ProductCategory::create([
                        'products_id'=>$pid,
                        'categories_id'=>$req->category,
                    ]);
                    ProductAttributeAssoc::create([
                        'products_id'=>$pid,
                        'price'=>$req->price,
                        'quantity'=>$req->quantity,
                        'features'=>$req->features,
                    ]);
                    // ProductImage::create([
                    //     'products_id'=>$pid,
                    //     'images'=>implode('|',$image),
                    // ]);
                    if ($req->hasFile('file') ) {
                        $images = $req->file('file');
                        foreach ($images as $i) {
                            $name = rand() . $i->getClientOriginalName();
                            $i->move(public_path('uploads/'), $name);
                            ProductImage::create([
                                "images" => $name,
                                "products_id" => $pid,
                            ]);
                        }
                    }
                    else {
                        $path=public_path()."uploads/".$name;
                        unlink($path);
                        return back()->with('error','uploading error');
                    } 
                }
                return redirect('products'); 
            }
            else {
                $path=public_path()."uploads/".$filename;
                unlink($path);
                return back()->with('error','uploading error');
            }    
        }
        else{
            return back()->with('error', "something went wrong") ;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::all();
        $product=Product::where('id',$id)->first();
        $image = ProductImage::with('Product')->where('products_id',$id)->get();
        return view('admin.pages.updateproduct',compact('data','product','image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validate=$req->validate([
            'pname'=>'required|min:2',
            'price'=>'required|numeric',
            'quantity'=>'required|numeric',
            'features'=>'required|min:6|max:255',
            'file'=>'required',
         
        ]);
        if($validate){
            $image=array();
            $imageextension=['jpeg','png','gif','jpg'];
            $files=$req->file('file');
            if( $files && $imageextension){
                Product::where('id',$id)->update([
                    'pname'=>$req->pname,
                ]);
                ProductCategory::where('products_id',$id)->update([
                    'categories_id'=>$req->category,
                ]);
                ProductAttributeAssoc::where('products_id',$id)->update([
                    'price'=>$req->price,
                    'quantity'=>$req->quantity,
                    'features'=>$req->features,
                ]);
              
                if ($req->hasFile('file')) {
                    $deleteImages = ProductImage::where('products_id', $id)->get();
                    foreach ($deleteImages as $i) {
                        unlink('uploads/'.$i->images);
                    }
                    ProductImage::where('products_id', $id)->delete();
                    $images = $req->file('file');
                    foreach ($images as $i) {
                        $name = rand() . $i->getClientOriginalName();
                        $i->move(public_path('uploads/'), $name);
                        ProductImage::insert([
                            "images" => $name,
                            "products_id" => $id,
                        ]);
                    }
                }
                else {
                    $path=public_path()."uploads/".$name;
                    unlink($path);
                    return back()->with('error','uploading error');
                } 
                return redirect('products'); 
            }
            else {
                $path=public_path()."uploads/".$filename;
                unlink($path);
                return back()->with('error','uploading error');
            }    
        }
        else{
            return back()->with('error', "something went wrong") ;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $product_data=Product::find($id);
        // $image = ProductImage::where('product_id', $id)->get();       
        //     foreach ($image as $product) {
        //         unlink(public_path('uploads/') . $product->images);
        //     }
        // $product_data->delete();
        $product_data = Product::find($id);
        $images =  ProductImage::where('products_id', $id)->get(); 
        foreach ($images as $i) {
            unlink("uploads/$i->images");
        }
        $product_data->delete();
      
        // if($product_data->delete()){
        //     return response()->json(['msg'=>"user deleted"]);
        // }
        // else{
        //     return response()->json(['msg'=>"user could not be deleted"]);
        // }
    }
}
