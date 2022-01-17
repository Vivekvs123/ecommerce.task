<!DOCTYPE html>
<html lang="en">
<head>
 @include('admin.includes.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

  @include('admin.includes.nav')
  @include('admin.includes.sidebar')
<div class="content-wrapper mt-5">
    <!-- Content Header (Page header) -->
    <div class="content-header ">
    <h1 class=" bg jumbotron text-center text-white">Update Configuration</h1>
      <div class="container-fluid  ">
        <div class="row mb-2">
        <div class="card-body">
                @if(Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
          <div class="col-sm-6 mt-2 ">
                <form method="post" action="{{url('configuration/'.$conf->id)}}">
                    @csrf()
                    @method('PUT')
                    <div class="form-group">
                        <label for="admin_email">Admin Email </label>
                        <input type="text" class="form-control" id="admin_email" name="admin_email"  placeholder="Enter admin email" value="{{$conf->admin_email}}" >
                        @if($errors->has('admin_email'))
                            <label  class="alert alert-danger">{{$errors->first('admin_email')}}</label>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label for="notification_email">Notification Email </label>
                        <input type="text" class="form-control" id="notification_email" name="notification_email"  placeholder="Enter notification email" value="{{$conf->notification_email}}">
                        @if($errors->has('notification_email'))
                            <label  class="alert alert-danger">{{$errors->first('notification_email')}}</label>
                        @endif
                    </div>   
                    <div class="mt-2">
                        <button type="submit" class="btn btn-warning">Update Notification Email</button>
                    </div>
                </form>
                </div><!-- /.col -->

</div><!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
        
        
@include('admin.includes.foot')
</body>
</html>