<nav 
@if (Auth::user()->user_type_id==2)
  style="margin-left:0px;" 
@endif 
class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('dashboard')}}" class="nav-link"><i class="fas fa-igloo"></i> Dashboard</a>
      </li>
      @if (Auth::user()->user_type_id==2)
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('bookingorder/create')}}" class="nav-link"><i class="fas fa-cart-plus"></i> New Booking Order</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('bookingorder')}}" class="nav-link"><i class="fas fa-database"></i> Booking Order List</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('order/search')}}" class="nav-link"><i class="fas fa-chart-pie"></i> Filter / Export Booking Report</a>
      </li>
      <form class="form-inline ml-3" method="post" action="{{url('order/search')}}">
        {{ csrf_field() }}
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search Order" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      @else
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('bookingorder/create')}}" class="nav-link"><i class="fas fa-cart-plus"></i> New Booking Order</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('bookingorder')}}" class="nav-link"><i class="fas fa-database"></i> Booking Order List</a>
      </li>
      <form class="form-inline ml-3" method="post" action="{{url('order/search')}}">
        {{ csrf_field() }}
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search Order" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      @endif
      
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> --}}
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('change/password')}}" class="nav-link"><i class="fas fa-key"></i> Change Password</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('user/profile')}}" class="nav-link"><i class="fas fa-user"></i> Profile</a>
      </li>
      <li class="nav-item">
        <a  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" href="javascript:void(0);" class="nav-link"><i class="fas fa-lock"></i> Logout</a>
      </li>
    </ul>
  </nav>


<form id="logout-form" action="{{url('logout')}}" method="POST" style="display: none;">
    {{csrf_field()}}
</form>
   
  <!-- /.control-sidebar -->