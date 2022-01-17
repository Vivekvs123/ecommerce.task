@extends('admin.master')
@section('content')
<div class="content-wrapper p-4">   
<div class="container mt-5 ">  
    <div class="container-fluid">
        <div class="card bg text-light">
            <div class="card-header row">
                <div class="col-sm-2">
                    {{ __('Orders') }}
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <table class="table" id="example1">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Customer Email</th>
                        <th scope="col">Customer Address</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Customer ZipCode</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Order+ (deliveryCharge)</th>
                     
                        
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userdetails as $detail )
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$detail->firstname}} {{$detail->lastname}}</td>
                                <td>{{$detail->email}}</td>
                                <td>{{$detail->address1}}</td>
                                <td>{{$detail->phone}}</td>
                                <td>{{$detail->zip}}</td>
                                @foreach ($orderdetails as $ordetail)
                                   
                                        <td>{{$ordetail->producttotal}}</td>
                                        <td>{{$ordetail->finalTotal}}</td>
                                     
                                           
                                    
                                  
                                @endforeach
                                <td><a href="showorderdetails/{{ $detail->id }}" class="btn btn-info btn-sm" role="button">Details</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection