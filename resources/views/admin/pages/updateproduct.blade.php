@extends('admin.master')
@section('content')
<div class="content-wrapper">
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1 class=" bg jumbotron text-center text-white">Update Product</h1>
                <div class="card-body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    <section class="container">
                        <form method="post" action="{{url('products/'.$product->id)}}" enctype="multipart/form-data">
                            @csrf()
                            @method('PUT')
                            <div class="form-group">
                                <label for="category">Choose a category:</label>
                                <select name="category" id="category" class="form-control form-control-lg">
                                    @foreach($data as $selectdata)
                                        <option value="{{$selectdata->id}}" {{$product->ProductCategory->Category->categories_id == $selectdata->id  ? 'selected' : ''}}>{{$selectdata->name}}</option>
                                    @endforeach 
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="pname" class="form-control" placeholder="Enter pname" value="{{$product->pname}}"/>
                                @if($errors->has('pname'))
                                    <label class="alert alert-danger">{{$errors->first('pname')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" placeholder="Enter price" value="{{$product->ProductAttributeAssoc->price}}"/>
                                @if($errors->has('price'))
                                    <label class="alert alert-danger">{{$errors->first('price')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" value="{{$product->ProductAttributeAssoc->quantity}}"/>
                                @if($errors->has('quantity'))
                                    <label class="alert alert-danger">{{$errors->first('quantity')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Features</label>
                                <textarea name="features" class="form-control" placeholder="Enter Features">{{$product->ProductAttributeAssoc->features}}</textarea>
                                 @if($errors->has('features'))
                                    <label class="alert alert-danger">{{$errors->first('features')}}</label>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Upload Image</label>
                                <input type="file" name="file[]" class="form-control" multiple />
                                @if($errors->has('file'))
                                    <label class="alert alert-danger">{{$errors->first('file')}}</label>
                                @endif
                            </div>
                            <div>
                            <button type="submit" class="btn btn-warning">Update Product</button>
                            <a href="{{url('products')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
                    </section>    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection