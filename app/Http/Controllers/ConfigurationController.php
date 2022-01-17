<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Configuration;
use App\Models\User;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // Configuration::create([
        //     'user_id'=>$conf->id,
        //     'admin_email'=>$conf->email,
        //     'notification_email'=>$conf->email,
        // ]);
        // $rid=Role::where('role_name','admin')->pluck('id');
        // $conf=User::where('role_id',$rid)->first();
        $conf=Configuration::all();
        // $conf= Configuration::with('User');
        // dd($conf);
        // $rid=Role::where('role_name','admin')->pluck('id');
        // $conf=User::where('role_id',$rid)->first();
        return view('admin.pages.showconfiguration',compact('conf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rid=Role::where('role_name','admin')->pluck('id');
        $conf=User::where('role_id',$rid)->first();
        return view('admin.pages.addconfiguration',compact('conf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Configuration::create([
            "admin_email" => $request->admin_email,
            "notification_email" => $request->notification_email, 
        ]);
        return redirect('configuration');
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
            $conf=Configuration::where('id',$id)->first();
            return view('admin.pages.updateconfiguration',compact('conf')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate=$request->validate([
            "admin_email" => 'required',
            "notification_email" => 'required', 
        ]);
        if($validate){
            Configuration::where('id',$id)->update([
                "admin_email" => $request->admin_email,
                "notification_email" => $request->notification_email, 
            ]);
            return redirect('configuration');
        }
        else{
            return back()->with('error','All fields are required');
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
        //
    }
}
