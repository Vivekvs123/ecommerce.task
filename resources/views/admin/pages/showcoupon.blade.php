<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @include('admin.includes.nav')
    @include('admin.includes.sidebar')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delcoupon').click(function(e){
                if(confirm("Are you sure you want to delete this?")){
                var cid=$(this).attr("cid");
                    $.ajax({
                        url:"coupons/"+cid,
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
                        <div class="card-body">
                            <table class="table " id="mytable">
                                <div class="text-center">
                                    <a href="{{url('coupons/create')}}" class="btn btn-success ml-5 mt-5"><i class="fas fa-plus"></i> Add Coupon</a>
                                </div>
                                <thead>
                                <thead>
                                        <tr>
                                            <th scope="col">Sno</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Cart value</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sn=1;
                                        @endphp
                                        @foreach($data as $i)
                                            <tr>
                                                <td>{{$sn++}}</td>
                                                <td>{{$i->code}}</td>
                                                <td>{{$i->type}}</td>
                                                <td>{{$i->value}}</td>
                                                <td>{{$i->cart_value}}</td>
                                                @if($i->status==1)
                                                    <td class="text-success">Active</td>
                                                @else
                                                    <td class="text-danger">In Active</td>
                                                @endif
                                                <td>
                                                    <a href="{{url('coupons/'.$i->id.'/edit')}}" class="btn  mr-2" ><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:void(0)" cid="{{$i->id}}" class="btn text-danger mt-2 delcoupon"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <span>{{$data->links()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.foot')
</body>
</html>
<style>
    .w-5{
        display:none;
    }
</style>