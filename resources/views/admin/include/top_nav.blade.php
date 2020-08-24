<nav 
@if (Auth::user()->user_type_id==2)
  style="margin-left:0px;" 
@endif 
class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">    
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> Menu
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        @if (Auth::user()->user_type_id==1)
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i> Sidebar</a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{url('dashboard')}}" class="nav-link"><i class="fas fa-igloo"></i> Dashboard</a>
        </li>
        @if (Auth::user()->user_type_id==2)
        <li class="nav-item">
          <a href="{{url('bookingorder/create')}}" class="nav-link"><i class="fas fa-cart-plus"></i> New Booking Order</a>
        </li>
        <li class="nav-item">
          <a href="{{url('bookingorder')}}" class="nav-link"><i class="fas fa-database"></i> Booking Order List</a>
        </li>
        <li class="nav-item">
          <a href="{{url('order/search')}}" class="nav-link"><i class="fas fa-chart-pie"></i> Filter / Export Booking Report</a>
        </li>
        @else
        
        <li class="nav-item">
          <a href="{{url('bookingorder/create')}}" class="nav-link"><i class="fas fa-cart-plus"></i> New Booking Order</a>
        </li>
        <li class="nav-item">
          <a href="{{url('bookingorder')}}" class="nav-link"><i class="fas fa-database"></i> Booking Order List</a>
        </li>
        
        @endif
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline" method="post" action="{{url('order/search')}}">
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
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('change/password')}}" class="nav-link"><i class="fas fa-key"></i> Change Password</a>
      </li>
      <li class="nav-item">
        <a href="{{url('user/profile')}}" class="nav-link"><i class="fas fa-user"></i> Profile</a>
      </li>
      <li class="nav-item">
        <a  onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" href="javascript:void(0);" class="nav-link"><i class="fas fa-lock"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>
<form id="logout-form" action="{{url('logout')}}" method="POST" style="display: none;">
    {{csrf_field()}}
</form>
   
  <!-- /.control-sidebar -->