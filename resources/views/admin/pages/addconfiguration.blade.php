<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.includes.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  @include('admin.includes.nav')
  @include('admin.includes.sidebar')
  <div class="content-wrapper mt-5">
   <h1 class=" bg jumbotron text-center text-white">Add Configuration</h1>
    <div class="container-fluid  ">
      <div class="row mb-2">
        <div class="card-body">
          
            <form method="post" action="{{url('configuration')}}" enctype="multipart/form-data">
              @csrf()
              <div class="form-group">
                <label for="admin_email">Admin Email </label>
                <input type="text" class="form-control" id="admin_email" name="admin_email" placeholder="Enter admin email" value="{{$conf->email}}">

              </div>
              <div class="form-group">
                <label for="notification_email">Notification Email </label>
                <input type="text" class="form-control" id="notification_email" name="notification_email" placeholder="Enter admin email" value="{{$conf->email}}">

              </div>
              <div class="mt-2">
                <button type="submit" class="btn btn-warning">Add Notification Email</button>
              </div>
            </form>
          </div><!-- /.col -->

        </div><!-- /.row -->
     
    </div>
    


    @include('admin.includes.foot')
</body>

</html>