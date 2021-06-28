
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(180deg, #56759F 0%, #1D3557 100%);">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link" style="background: #034EA1">
      <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}"
           alt="Admin Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Borak Merchant</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="{{url('crud')}}" class="nav-link {{ Request::path() == 'crud' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>CRUD</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('bookingorder/create')}}" class="nav-link {{ Request::path() == 'bookingorder/create' ? 'active' : '' }}">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Booking Order</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('order/search')}}" class="nav-link {{ Request::path() == 'order/search' ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Booking Order Report</p>
            </a>
          </li>

         <li class="nav-item">
            <a href="{{url('bookingorder/bulkUpload')}}" class="nav-link {{ Request::path() == 'bookingorder/bulkUpload' ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-upload"></i>
              <p>Bulk Order Upload</p>
            </a>
          </li>

          

{{-- 
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('merchantinfo','merchantinfo/list','merchantmfs','merchantmfs/list','merchantbankinfo','merchantbankinfo/list'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('merchantinfo','merchantinfo/list','merchantbankinfo','merchantbankinfo/list'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                API Integration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('merchantapi/gettoken')}}" class="nav-link {{ (Request::path() == 'merchantapi' || Request::path() == 'merchantapi') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Get API Token</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('merchantapi/documentation')}}" class="nav-link {{ (Request::path() == 'merchantapi' || Request::path() == 'merchantapi/documentation') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>API Documentation</p>
                </a>
              </li>
              
              
            </ul>
          </li> --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    {{-- ============================================ --}}
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
    {{-- <div class="side-bar-bottom">
        <ul class="list-unstyled">
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Edit Profile"><a
              href="#"><i class="fas fa-cog"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Change Password"><a
              href="#"><i class="fas fa-key"></i></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Lockscreen"><a
              href="#"><i class="fas fa-unlock"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Logout">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
            </a>
           
          </li>
        </ul>
      </div> --}}
      <!-- End side-bar-bottom -->
  </aside>

  <style type="text/css">
    .side-bar-bottom {
      width: 100%;
      height: 35px;
      background-color: #343a40;
      position: -webkit-sticky;
      position: sticky;
      bottom: 0px;
      margin-top: 93%;
      color: #cccccc;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      border-top: 2px solid #444a50;
      padding-top: 25px;
      /*-webkit-box-shadow: 0px 2px 5px 5px black;
      box-shadow: 0px 2px 5px 5px black;*/
  }
  .side-bar-bottom ul li a i{
    color: #fff;
    padding: 10px;
  }
  </style>