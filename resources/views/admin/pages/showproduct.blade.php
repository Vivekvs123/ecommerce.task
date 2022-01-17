<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('admin.includes.nav')
    @include('admin.includes.sidebar')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delpro').click(function(e) {

                if (confirm("Are you sure you want to delete this?")) {
                    var cid = $(this).attr("cid");
                    $.ajax({
                        url: "products/" + cid,
                        type: 'delete',
                        data: {
                            _token: '{{csrf_token()}}',
                            cid: cid
                        },
                        success: function(response) {

                            $("#mytable").load(location.href + " #mytable");
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    </script>

    <div class="content-wrapper mt-2">


        <div class="container-fluid  ">
            <div class="row mb-2">




                <div class="card-body bg">
                    <table class="table " id="mytable">
                        <div class="text-center">
                            <a href="{{url('products/create')}}" class="btn btn-success ml-5 mt-5">Add Product</a>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">Sr.NO</th>
                                <th scope="col">Category</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Features</th>
                                <th scope="col">Images</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sn=1;
                            @endphp
                            @foreach($products as $product)
                            <tr>
                                <td>{{$sn}}</td>
                                <td>{{$product->ProductCategory->Category->name}}</td>
                                <td>{{$product->pname}}</td>
                                <td>{{$product->ProductAttributeAssoc->price}}</td>
                                <td>{{$product->ProductAttributeAssoc->quantity}}</td>
                                <td>{{$product->ProductAttributeAssoc->features}}</td>
                                <td>
                                    @foreach($product->ProductImage as $image)
                                    <img src="{{asset('/uploads/'.$image->images)}}" alt="image" width="50" height="50">
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{url('products/'.$product->id.'/edit')}}" class="btn  mr-2"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0)" cid="{{$product->id}}" class="btn text-danger  mt-2 delpro"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @php
                            $sn++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <span>{{$products->links()}}</span>
                </div>
            </div>
        </div>
        @include('admin.includes.foot')
</body>

</html>
<style>
    .w-5 {
        display: none;
    }
</style>