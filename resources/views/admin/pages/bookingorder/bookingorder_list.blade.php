
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
                            <th class="text-center">Merchant Business</th>
                            <th class="text-center">Merchant Phone</th>
                            <th class="text-center">Pick up Address</th>
                            <th class="text-center">Recipient Name</th>
                            <th class="text-center">Recipient Phone</th>
                            <th class="text-center">Recipient Area</th>
                            <th class="text-center">Delivery Address</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Pick up Date</th>
                            <th class="text-center">Delivery Date</th>
                            <th class="text-center">Order Status</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Actions</th>

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
@endsection
<link rel="stylesheet" href ="{{asset('assets/customjs/datatables/datatables.bundle.css')}}">

@section("js")
    <script src="{{asset('assets/customjs/bookingorder.js')}}"></script>
    <script src="{{asset('assets/customjs/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/customjs/datatables/extensions/buttons.js')}}"></script>
@endsection
