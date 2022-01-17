@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class=" bg jumbotron text-center text-white">Update Category</h1>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    <form method="post" action="{{url('categories/'.$cat->id)}}">
                        @csrf()
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" value="{{$cat->name}}"/>
                             @if($errors->has('name'))
                                <label class="alert alert-danger">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description">{{$cat->description}}</textarea>
                            @if($errors->has('description'))
                                <label class="alert alert-danger">{{$errors->first('description')}}</label>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-warning">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection