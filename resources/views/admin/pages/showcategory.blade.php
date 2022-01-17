@extends('admin.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.delcat').click(function(e){

            if(confirm("Are you sure you want to delete this?")){
                var cid=$(this).attr("cid");
                $.ajax({
                    url:"categories/"+cid,
                    type:'delete',
                    data:{_token:'{{csrf_token()}}',cid:cid},
                    success:function(response){
                     
                        $("#mytable").load(location.href + " #mytable");
                    }
                });
            }
    else{
        return false;
    }   
        });
    });
</script>
<div class="content-wrapper">
<div class="container mt-5 ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg">
                <div class="text-center">
                    <a href="{{url('categories/create')}}" class="btn btn-success ml-5 mt-5">Add Category</a>
                </div>
                <div class="card-body">
                    <table class="table text-white" id="mytable">
                        <thead>
                            <tr>
                                <th scope="col">Sr.NO</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sn=1;
                            @endphp
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$sn}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>
                                        <a href="{{url('categories/'.$category->id.'/edit')}}" class="btn btn-warning text-white mr-2" >Update</a>
                                        <a href="javascript:void(0)" cid="{{$category->id}}" class="btn btn-danger mt-2 delcat">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $sn++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                  <span>{{$categories->links()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<style>
    .w-5{
        display:none;
    }
</style>