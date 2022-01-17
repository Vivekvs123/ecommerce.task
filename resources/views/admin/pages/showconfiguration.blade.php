<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('admin.includes.nav')
    @include('admin.includes.sidebar')
    <div class="content-wrapper">
        <div class="container mt-5 ">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card bg">
                        
                           
                                <div class="card-header ">
                                    <a href="{{url('configuration/create')}}" class="btn btn-success ml-5 mt-5 mb-4">Add Configuration</a>
                                </div>
                                <div class="card-body">
                                <table class="table " id="mytable">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Admin Email</th>
                                        <th scope="col">Notification Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sn=1;
                                    @endphp
                                    @foreach($conf as $con)
                                    <tr>
                                        <td>{{$sn}}</td>
                                        <td>{{$con->admin_email}}</td>
                                        <td>{{$con->notification_email}}</td>
                                        <td>
                                            <a href="{{url('configuration/'.$con->id.'/edit')}}" class="btn mr-2">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.foot')
</body>

</html>