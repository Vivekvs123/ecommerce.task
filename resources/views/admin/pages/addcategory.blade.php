@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class=" bg jumbotron text-center text-white">Add Category</h1>
                <div class="card-body">
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    <form method="post" action="{{url('categories')}}">
                        @csrf()
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" />
                            @if($errors->has('name'))
                            <label class="alert alert-danger">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" placeholder="Enter description"></textarea>
                            @if($errors->has('description'))
                            <label class="alert alert-danger">{{$errors->first('description')}}</label>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Add Category</button>
                            <a href="{{url('categories')}}" class="btn btn-primary">Back</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection