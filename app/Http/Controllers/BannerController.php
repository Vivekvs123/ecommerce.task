<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\AddBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->paginate(2);
        return view('admin.pages.showbanner', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.addbanner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        // if ($banner = $request->validated()) {

        //     $caption = $request->caption;
        //     $file = $request->file('image');
        //     $dest = public_path('/uploads');
        //     $fname = "Image-" . rand() . "-" . time() . "." . $file->extension();
        //     if ($file->move($dest, $fname)) {

        //         $bannerData = Banner::create($banner);



        //         // 
        //         return redirect('banners');
        //     } 
        //     else {
        //         $path = public_path() . "uploads/" . $fname;
        //         unlink($path);
        //         return back()->with('error', 'banner could not added');
        //     }
        // } 
        // else {
        //     return back()->with('error', 'Something went wrong');
        // }
    

        $validate=$req->validate([
                'caption'=>'required|min:5|max:150',
                'image'=>'required|mimes:jpg,png,jpeg',
            ]);
        if($validate){
           $caption=$req->caption;
           $file=$req->file('image');
           $dest=public_path('/uploads');
           $fname="Image-".rand()."-".time().".".$file->extension();
           if($file->move($dest,$fname))
           {
               Banner::create([
                'caption'=>$caption,
                'image'=>$fname,

               ]);
                return redirect("banners");
            }
            else{
                   $path=public_path()."uploads/".$fname;
                   unlink($path);
                   return back()->with('error','banner could not added');
               }
           }
           else {
               return back()->with('error','Uploading Error');
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
        $banner = Banner::where('id', $id)->first();
        return view('admin.pages.updatebanner', compact('banner'));
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
        $validate = $req->validate([
            'caption' => 'required|min:5|max:150',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);
        if ($validate) {
            $caption = $req->caption;
            $file = $req->file('image');
            $dest = public_path('/uploads');
            $fname = "Image-" . rand() . "-" . time() . "." . $file->extension();
            if ($file->move($dest, $fname)) {
                Banner::where('id', $id)->update([
                    'caption' => $caption,
                    'image' => $fname,

                ]);
                return redirect("banners");
            } else {
                $path = public_path() . "uploads/" . $fname;
                unlink($path);
                return back()->with('error', 'banner could not added');
            }
        } else {
            return back()->with('error', 'Uploading Error');
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
        $bannerdata = Banner::find($id);
        $imagepath = $bannerdata->image;
        if ($bannerdata->delete()) {
            unlink(public_path() . 'uploads/' . $imagepath);
            return response()->json(['msg' => "banner deleted"]);
        } else {
            return response()->json(['msg' => "banner could not be deleted"]);
        }
    }
}
