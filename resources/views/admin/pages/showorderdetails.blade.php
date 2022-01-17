@extends('admin.master')
@section('content')
<div class="content-wrapper p-4">   
<div class="container mt-5 ">  
<div class="container-fluid">
        <div class="card bg text-light">
            <div class="card-header row">
            <div class="col-sm-2">
                        {{ __('Order Details') }}
                    </div>
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2">
                        <a href="{{route('Orders')}}" class="btn btn-dark btn-sm" role="button">Back</a>
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
                            <th scope="col">Order Specification</th>
                            <th scope="col">Order Details</th>
                        </tr>
                    </thead> 
                    <tbody>  
                        <tr>
                            <th>1</th>
                            <th>Customer Name</th>
                            <td>{{$userdetails->firstname}} {{$userdetails->lastname}}</td>
                        </tr> 
                        <tr>
                            <th>2</th>
                            <th>Customer Email</th>
                            <td>{{$userdetails->email}}</td>
                        </tr> 
                        <tr>
                            <th>3</th>
                            <th>Customer Address</th>
                            <td>{{$userdetails->address1}} </td>
                        </tr> 
                        <tr>
                            <th>4</th>
                            <th>Customer Zip Code</th>
                            <th>{{$userdetails->zip}}</th>
                        </tr>
                        <tr>
                            <th>5</th>
                            <th>Customer Phone</th>
                            <td>{{$userdetails->phone}}</td>
                        </tr>
                        
                        <tr>
                            <th>7</th>
                            <th>Shipping Instructions</th>
                            <td>{{$userdetails->shipping}}</td>
                        </tr>
                        <tr>
                            <th>8</th>
                            <th>Product Details</th>
                            <td>
                            <table class="table">
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                </tr>
                                
                                @foreach ($orders as $order)
                                    @foreach ($product as $prod)
                                        @if ($order->product_id == $prod->id)
                                        <tr>
                                        @foreach($prod->ProductImage as $image)
                                           <td> <img src="{{asset('/uploads/'.$image->images)}}" alt="image" width="100" height="100">    </td> 
                                        @endforeach 
                                            <td>{{$prod->pname}}</td>
                                            <td>{{$prod->ProductAttributeAssoc->price}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>9</th>
                            <th>Order Total</th>
                            <td class="text text-danger">$ {{$orderdetails->producttotal}}</td>
                        </tr>
                        <tr>
                            <th>10</th>
                            <th>Billing Amount (* including coupons)</th>
                            <td class="text text-success">$ {{$orderdetails->finalTotal}}</td>
                        </tr>
                        
                        
                    </tbody>                
                </table>
            </div>
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