
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
      <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}"
           alt="Admin Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Borak Admin</span>
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
            <a href="{{url('bookingorder/adminBulkUpload')}}" class="nav-link {{ Request::path() == 'bookingorder/adminBulkUpload' ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-upload"></i>
              <p>Bulk Order Upload</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('order/search')}}" class="nav-link {{ Request::path() == 'order/search' ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>Booking Order Report</p>
            </a>
          </li>
          {{-- <li class="nav-item has-treeview {{ in_array(Request::path(),array('bookingrequest/create','bookingrequest','bookingconfiguration'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('bookingrequest/create','bookingrequest','bookingconfiguration'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Booking
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('bookingconfiguration')}}" class="nav-link {{ Request::path() == 'bookingconfiguration' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Configuration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingrequest/create')}}" class="nav-link {{ Request::path() == 'bookingrequest/create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Booking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingrequest')}}" class="nav-link {{ Request::path() == 'bookingrequest' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('rentalbooking/create')}}" class="nav-link {{ Request::path() == 'rentalbooking/create' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Rental Booking</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('rentalbooking')}}" class="nav-link {{ Request::path() == 'rentalbooking' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rental Booking List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('payment/log')}}" class="nav-link {{ Request::path() == 'payment/log' ? 'active' : '' }}">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>Payment log</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('slider')}}" class="nav-link {{ Request::path() == 'slider' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Slider</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('dreamcontent')}}" class="nav-link {{ Request::path() == 'dreamcontent' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dream Content</p>
            </a>
          </li>
          
          
          
          
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('exploreshelterinfo','shelterphoto'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('exploreshelterinfo','shelterphoto'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Explore The Shelter
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('exploreshelterinfo')}}" class="nav-link {{ Request::path() == 'exploreshelterinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Explore Shelter Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('shelterphoto')}}" class="nav-link {{ Request::path() == 'shelterphoto' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shelter Photos</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <li class="nav-item has-treeview {{ in_array(Request::path(),array('sendingtype','bookingdeliverytype','bookingpackage','city','bookingarea','paymentmethod','shippingcost'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('sendingtype','bookingdeliverytype','bookingpackage','city','bookingarea','paymentmethod','shippingcost'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Booking Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sendingtype')}}" class="nav-link {{ Request::path() == 'sendingtype' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Sending Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingdeliverytype')}}" class="nav-link {{ Request::path() == 'bookingdeliverytype' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Delivery Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingpackage')}}" class="nav-link {{ Request::path() == 'bookingpackage' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Package</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('city')}}" class="nav-link {{ Request::path() == 'city' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking City</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bookingarea')}}" class="nav-link {{ Request::path() == 'bookingarea' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('paymentmethod')}}" class="nav-link {{ Request::path() == 'paymentmethod' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Method</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('shippingcost')}}" class="nav-link {{ Request::path() == 'shippingcost' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Booking Cost</p>
                </a>
              </li>
            </ul>
          </li>
          


          <li class="nav-item has-treeview {{ in_array(Request::path(),array('merchantinfo','merchantinfo/list','merchantmfs','merchantmfs/list','merchantbankinfo','merchantbankinfo/list'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('merchantinfo','merchantinfo/list','merchantbankinfo','merchantbankinfo/list'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Merchant
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('merchantinfo')}}" class="nav-link {{ (Request::path() == 'merchantinfo' || Request::path() == 'merchantinfo/list') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merchant Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('merchantmfs')}}" class="nav-link {{ (Request::path() == 'merchantmfs' || Request::path() == 'merchantmfs/list') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merchant MFS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('merchantbankinfo')}}" class="nav-link {{ Request::path() == 'merchantbankinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Merchant Bank Info</p>
                </a>
              </li>
              
            </ul>
          </li>

          
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('sitesetting','userrole','paymenttype','walletprovider','itemtype','bankaccounttype','slidersetting'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('sitesetting','userrole','paymenttype','walletprovider','itemtype','bankaccounttype','slidersetting'))?'active':'' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sitesetting')}}" class="nav-link {{ Request::path() == 'sitesetting' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('userrole')}}" class="nav-link {{ Request::path() == 'userrole' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('paymenttype')}}" class="nav-link {{ Request::path() == 'paymenttype' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Type</p>
                </a>
              </li>
              
  
              <li class="nav-item">
                <a href="{{url('walletprovider')}}" class="nav-link {{ Request::path() == 'walletprovider' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Wallet Provider</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('itemtype')}}" class="nav-link {{ Request::path() == 'itemtype' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Percel Item Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('bankaccounttype')}}" class="nav-link {{ Request::path() == 'bankaccounttype' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Account Type</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('slidersetting')}}" class="nav-link {{ Request::path() == 'slidersetting' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider CMS</p>
                </a>
              </li>
              
              
            </ul>
          </li>

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