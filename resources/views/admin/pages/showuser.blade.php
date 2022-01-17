@extends('admin.master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.deluser').click(function(e){

            if(confirm("Are you sure you want to delete this?")){
                var cid=$(this).attr("cid");
                $.ajax({
                    url:"users/"+cid,
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
                    <a href="{{url('users/create')}}" class="btn btn-success ml-5 mt-5">Add User</a>
                </div>
                <div class="card-body">
                    <table class="table text-white" id="mytable">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col"> First Name</th>
                                <th scope="col"> Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sn=1;
                            @endphp
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$sn}}</td>
                                    <td>{{$user->firstname}}</td>
                                    <td>{{$user->lastname}}</td>
                                    <td>{{$user->email}}</td>
                                    @if($user->status==1)
                                        <td>Active</td>
                                    @else
                                        <td>InActive</td>
                                    @endif
                                    <td>{{$user->Role->role_name}}</td>
                                    <td>
                                        <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-warning text-white mr-2" >Update</a>
                                        <a href="javascript:void(0)" cid="{{$user->id}}" class="btn btn-danger mt-2 deluser">Delete</a>
                                    </td>
                                </tr>
                                @php
                                    $sn++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                  <span>{{$users->links()}}</span>
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