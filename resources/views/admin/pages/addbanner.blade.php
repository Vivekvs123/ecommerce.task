@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class=" bg jumbotron text-center text-white">Add Banner</h1>
                <div class="card-body">
                    @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    <form method="post" action="{{url('banners')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" class="form-control" id="caption" name="caption" placeholder="Enter caption">
                            @if($errors->has('caption'))
                            <label class="alert alert-danger">{{$errors->first('caption')}}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image">
                            @if($errors->has('image'))
                            <label class="alert alert-danger">{{$errors->first('image')}}</label>
                            @endif
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success">Add Banner</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection