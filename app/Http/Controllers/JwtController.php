<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\contactus;
use App\Models\Banner;
use App\Models\CMS;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserDetails;
use App\Models\OrderDetails;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use App\Mail\registermail;
use App\Mail\ordermail;
use Illuminate\Support\Facades\Mail;


class JwtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register','contact','banner','category','product','show','changePassword','checkout','cms']]);
    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'firstname'=>'required|min:2|alpha',
            'lastname'=>'required|min:2|alpha',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|max:12',
            'cpassword'=>'required|min:6|max:12|required_with:password|same:password',
        ]);
        Mail::to($request->email)->send(new registermail($request->all()));
       
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'status'=>$request->status ?? '1',
                'role_id' => $request->role ?? '5',
            ]);
            return response()->json([
                'message'=>'User create successfully',
                'user'=>$user
            ],201);
        }
    }

    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:6|max:12',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::where('email',$request->email)->first();
           
            if ($user->status ==1) {
                if(!$token=auth()->attempt($validator->validated())){
                return response()->json(['token' => $token,'error'=>0 ,'message' => 'Login successfully.', 'status' => 1, 'email'=>$request->email],200);
            }
        }
           else {
                 return response()->json(['token' => '','error'=>0, 'message' => 'User is inactive.', 'status' => 0]);
                }
        }
        return response()->json(['token' => $token,'error'=>0 ,'message' => 'Login successfully.', 'status' => 1, 'email'=>$request->email],200);
          
    }

    public function checkout(Request $req){
        // return response()->json($req->all());
        $uemail = $req->email;

        $user = User::where('email',$uemail)->first();
        $userdetails = new UserDetails();
        $userdetails->user_id = $user->id;
        $userdetails->email = $req->email;
        $userdetails->firstname = $req->firstname;
        $userdetails->lastname = $req->lastname;
        $userdetails->address1 = $req->address1;
        $userdetails->zip = $req->zip;
        $userdetails->phone = $req->phone;
        $userdetails->shipping = $req->shipping;
        $userdetails->save();

        $userdetail = UserDetails::latest()->first();

        $orders = $req->product;
    
            foreach($orders as $ord)
            {
                $order = new Order();
                $order->userdetail_id = $userdetail->id;
                $order->product_id = $ord['pid'];
                $order->save();

                
                $orderdetail = new OrderDetails();
                $orderdetail->userdetail_id = $userdetail->id;
                $orderdetail->order_id = $order->id;
                $orderdetail->producttotal = $req->producttotal;
                $orderdetail->finalTotal = $req->finalTotal;
                $orderdetail->coupon_id =$req->coupon;
                $orderdetail->save();


            }
           
            
            Mail::to($req->email)->send(new ordermail($req->all()));


        return response()->json(['msg'=>"Order Placed Successfully !"],200);
    }

   

    
    public function get_user(Request $request)
    {
        $user = User::latest()->get();
 
        return response()->json(['user' => $user]);
    }
    public function logout(){
        auth()->logout();
        return response()->json(["message"=>"User Logout Successfully"]);
    }
    public function respondWithToken($token){
        return response()->json([
            'access_token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>auth()->factory()->getTTL()*60
        ]);
    }
    public function profile(){
        $profile=auth('api')->user();
         return response()->json(['profile'=>$profile]);
     }

     public function changePassword(Request $request){


        $validator = Validator::make($request->all(), [
            'oldpass'=>'required',
            'newpass'=>'required|min:6|max:100',
            'confirmpass'=>'required|same:newpass'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'error'=>$validator->errors()
            ],422);
        }

        $user=User::where('email',$request->email)->first();
        if(Hash::check($request->oldpass,$user->password)){
            $user->update([
                'password'=>Hash::make($request->newpass)
            ]);
            return response()->json([
                'message'=>'Password successfully updated',
            ],200);
        }else{
            return response()->json([
                'message'=>'Old password does not matched'
            ],400);
        }

    }
    // public function profile(){
    //     $arr=["vivek","Maddy"];
    //     return response()->json($arr);
    // }
    public function refresh(){
        return $this->responseWithToken(auth()->refresh());
    }
    public function banner()
    {
        $banner = Banner::all();
        foreach($banner as $ban){
            $listbanner[]=[
                'caption'=>$ban->caption,
                'image'=> asset('uploads/'.$ban->image)
              ];
          }
 
        return response()->json(['banner' => $listbanner]);
    }
    public function cms()
    {
        $cms = CMS::all();
        foreach($cms as $cmss){
            $listcms[]=[
                'title'=>$cmss->title,
                'description'=>$cmss->description,
                'image'=> asset('images/'.$cmss->image)
              ];
          }
 
        return response()->json(['cms' => $listcms]);
    }

    public function category()
    {
        $category = Category::all();
        foreach($category as $cat){
            $listcat[]=[
                'id'=>$cat->id,
                'name'=>$cat->name,
                'description'=>$cat->description,
              ];  
          }
 
        return response()->json(['category' => $listcat]);
    }
    public function product()
    {
        $products = Product::with('ProductImage','ProductAttributeAssoc')->get();
        return response()->json(['products' => $products]);
    //    
     }

   public function show($id)
    { 
        $list = [];
        $product = Product::join('product_categories','products.id','=','product_categories.products_id')->where('product_categories.categories_id',$id)->get();
        foreach ($product as $prod) {
            foreach($prod->ProductImage as $image){
                $listimage[]=[
                    'image'=> asset('uploads/'.$image->images)
                  ];
          }
            $list[] = [
                'name' => $prod->pname,
                'pid' => $prod->id,
                'category'=>$prod->ProductCategory,
                'attributes'=>$prod->ProductAttributeAssoc,
                'images'=>$listimage,
            ];
            $listimage = [];
        }

        return response()->json(['categorybyid' => $list]);
    }

   public function contact(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:2',
            
            'email'=>'required|email',
            'subject'=>'required|min:2|alpha',
            'message'=>'required|min:2|alpha',
            
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $contact=contactus::create([
                'name'=>$request->name,
                
                'email'=>$request->email,
                'subject'=>$request->subject,
                'message'=>$request->message,
               
            ]);
            return response()->json([
                'message'=>'contact create successfully',
                'contact'=>$contact
            ]);
        }
    } 
    

}
