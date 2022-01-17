<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::paginate(2);
        return view('admin.pages.showcategory',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('admin.pages.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCategoryRequest $request)
    {
        if( $category = $request->validated()){
            $userData = Category::create($category);
            // 
            return redirect('categories');
        } 
        else {
            return back()->with('error', 'Something went wrong');
        }
        // $validate=$req->validate([
        //     'name'=>'required|min:2|unique:categories|alpha',
        //     'description'=>'required|min:10|max:255',
        // ]);
        // if($validate){
        //     Category::create([
        //         'name'=>$req->name,
        //         'description'=>$req->description,
        //     ]);
        //     return redirect('categories');
        // }
        // else{
        //     return back()->with('error','All fields are required');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat=Category::where('id',$id)->first();
        return view('admin.pages.updatecategory',compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddCategoryRequest $request,$id)
    {
        if( $category = $request->validated()){
            Category::where('id',$id)->update($category);
            // 
            return redirect('categories');
        } 
        else {
            return back()->with('error', 'Something went wrong');
        }
        // $validate=$req->validate([
        //     'name'=>'required|min:2|alpha',
        //     'description'=>'required|min:10|max:255',
        // ]);
        // if($validate){
        //     Category::where('id',$id)->update([
        //         'name'=>$req->name,
        //         'description'=>$req->description,
        //     ]);
        //     return redirect('categories');
        // }
        // else{
        //     return back()->with('error','All fields are required');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catdata=Category::find($id);
        $catdata->Product()->delete();
        $catdata->delete();
        // if($catdata->product()->delete()){
        //     return response()->json(['msg'=>"Category deleted"]);
        // }
        // else{
        //     return response()->json(['msg'=>"Category could not be deleted"]);
        // }
    
    }

    public function apicategory()
    {
        return CategoryResource::collection(Category::all());
    }
}
