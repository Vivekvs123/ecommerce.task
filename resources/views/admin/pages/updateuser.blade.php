@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container mt-5  ">
    <div class="wrapper">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h1 class=" bg jumbotron text-center text-white">Update User</h1>
                    <div class="card-body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
                        <form method="post" action="{{url('users/'.$users->id)}}">
                            @csrf()
                            @method('PUT')
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter firstname" value="{{$users->firstname}}">
                                @if($errors->has('firstname'))
                                <label class="alert alert-danger">{{$errors->first('firstname')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter lastname" value="{{$users->lastname}}">
                                @if($errors->has('lastname'))
                                <label class="alert alert-danger">{{$errors->first('lastname')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" value="{{$users->email}}">
                                @if($errors->has('email'))
                                <label class="alert alert-danger">{{$errors->first('email')}}</label>
                                @endif
                            </div>
                            <div>
                                <label for="status">Status</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="active" name="status" class="custom-control-input" value="1" {{ ($users->status=="1")? "checked" : "" }}>
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="inactive" name="status" class="custom-control-input" value="0" {{ ($users->status=="0")? "checked" : "" }}>
                                <label class="custom-control-label" for="inactive">Inactive</label>
                            </div>
                            @if($errors->has('status'))
                            <label class="alert alert-danger">{{$errors->first('status')}}</label>
                            @endif
                            <div>
                                <label for="role">Role</label>

                                <select class="form-control" name="role">
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$users->role_id == $role->id  ? 'selected' : ''}}>{{$role->role_name}}</option>
                                    @endforeach
                                </select>

                                <!-- <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="role" value="{{$role->id}}" @if($role->id==5) checked @endif >
                                <label class="form-check-label" for="{{$role->id}}">{{$role->role_name}}</label>
                            </div> -->

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-warning">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection