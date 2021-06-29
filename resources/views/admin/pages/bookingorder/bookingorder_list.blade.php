
@extends("admin.layout.master")
@section("title","Booking Order")
@section("content")
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Booking Order</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('bookingorder/create')}}">Create New </a></li>
                  <li class="breadcrumb-item active">Booking Order Data</li>
                </ol>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include("admin.include.msg")
                </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        
        <section class="content">
          <div class="row">
            <div class="col-12">
              <!-- /.card -->
              <div class="card">

                <div class="card-header">
                  <h3 class="card-title">Booking Order Data</h3>

                    <div class="card-tools">
                      <ul class="pagination pagination-sm float-right">
                        <li class="page-item">
                            <a class="page-link bg-primary" href="{{url('bookingorder/create')}}"> 
                                Add New 
                                <i class="fas fa-plus"></i> 
                            </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('bookingorder/export/pdf')}}">
                            <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" target="_blank" href="{{url('bookingorder/export/excel')}}">
                            <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                </div>


                
                <!-- /.card-header -->
                <div class="card-body" style="overflow: scroll;">
                    <table class="table table-bordered table-hover table-checkable  dt-responsive nowrap" id="dataList">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Merchant Name</th>
                            <th class="text-center">Merchant Phone</th>
                            <th class="text-center">Merchant Business</th>
                            <th class="text-center">Sending Type</th>
                            <th class="text-center">Rec. Number</th>
                            <th class="text-center">Rec. 2nd Number</th>
                            <th class="text-center">Rec. Name</th>
                            <th class="text-center">Special Notes</th>
                            <th class="text-center">Rec. City</th>
                            <th class="text-center">Rec. Area</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Landmark</th>
                            <th class="text-center">Pickup Address</th>
                            <th class="text-center">Product ID</th>
                            <th class="text-center">Parcel Type</th>
                            <th class="text-center">Del. Type</th>
                            <th class="text-center">Package</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Payment Method</th>
                            <th class="text-center">Del. Date</th>
                            <th class="text-center">No of Items</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Created</th>

                        </tr>
                    </thead>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </section>
@endsection
@section("css")
    @include("admin.include.lib.datatable.css")
@endsection
<link rel="stylesheet" href ="{{asset('assets/customjs/datatables/datatables.bundle.css')}}">

@section("js")
    @include("admin.include.lib.datatable.js")
    <script src="{{asset('assets/customjs/bookingorder.js')}}"></script>
    <script src="{{asset('assets/customjs/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/customjs/datatables/extensions/buttons.js')}}"></script>
@endsection
