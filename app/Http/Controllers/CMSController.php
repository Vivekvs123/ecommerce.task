<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;



class CMSController extends Controller
{
    public function AddCMS(){
        return view('admin.pages.addcms');
    }
    
    public function PostAddCMS(Request $req){
        $validateData = $req->validate([
            'heading' => ['required', 'string', 'max:255'],
            'cmsdescription' => ['max:1000'],
            'cmsimage' => ['required', 'mimes:jpg,png,jpeg,JPG,PNG,JPEG']
        ]);

        if ($validateData) {
            $file = $req->file('cmsimage');
            $fname = $file->getClientOriginalName();
            $filename = rand() . "-" . time() . "-" . $fname;
            $des = public_path('/images/cms');          

            $cms = new CMS();
            $cms->title = $req->heading;
            $cms->description = $req->cmsdescription;
            $cms->image = $filename;

            if ($file->move($des, $filename)) {                
                $cms->save();
                // alert()->success('CMS Added')->persistent('Close')->autoclose(145);
                return back()->with('status',"CMS Added !");
            }
        }
    }

    public function DisplayCMS(){
        $cms = CMS::all();
        return view('admin.pages.showcms',compact('cms'));
    }

    public function DeleteCMS(Request $req){
        try{
            $cms=CMS::where('id',$req->aid)->firstorFail();
            $destination=public_path('images/cms/'.$cms->image);
            if(File::exists($destination)){
                unlink($destination);
                $cms->delete();
            }
        }catch(\Exception $exception){
            return view('layouts.pagenotfound');
        }
        
        return back();
    }

    public function EditCMS($id){
        try{
            $cms = CMS::where('id',$id)->firstorFail();
            return view('adin.pages.updatecms',compact('cms'));
        }catch(\Exception $e){
            return view('layouts.pagenotfound');
        } 
    }

    public function PostEditCMS(Request $req){
        $validateData = $req->validate([
            'heading' => ['required', 'string', 'max:255'],
            'cmsdescription' => ['string', 'max:1000'],
            'cmsimage' => ['mimes:jpg,png,jpeg,JPG,PNG,JPEG'],
        ]);
        if ($validateData) {
            $banner = CMS::findorFail($req->id);
            
            if($req->hasFile('cmsimage')){
                
                $file = $req->file('cmsimage');
                $fname = $file->getClientOriginalName();
                $destination=public_path('images/cms/'.$banner->image);
                if(File::exists($destination)){
                    unlink($destination);
                } 
                $filename = rand() . "-" . time() . "-" . $fname;
                $des = public_path('/images/cms');
                $file->move($des, $filename);
                $banner->image = $filename;
            }
            $banner->title=$req->heading;
            $banner->description=$req->cmsdescription;
            $banner->save();
        }
        return back()->with('status',"Updates Successfully !");
    }
}