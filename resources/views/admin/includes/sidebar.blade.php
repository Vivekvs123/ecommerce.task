  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin panel</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('users')}}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               User 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('configuration')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
               Configuration 
               
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('banners')}}" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('categories')}}" class="nav-link">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Category 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('products')}}" class="nav-link">
            <i class="fa fa-list" aria-hidden="true"></i>
              <p>
                Product 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/coupons')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Coupon 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
              Notifications
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('contactus')}}" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
               Contact Us
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/cms')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              CMS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/order')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
              Order 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
              Reports
              </p>
            </a>
          </li>
         
        <li class="nav-item">
            <a  href="" class="nav-link"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
            </a>
        </li>
       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>