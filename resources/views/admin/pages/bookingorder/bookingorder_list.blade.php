
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
                  <table id="example2" class="table table-bordered table-striped">
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
                    <tbody>
                        @if(count($dataRow))
                            @foreach($dataRow as $row)  
                                <tr>
                                    <td class="text-center">
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-default">{{$row->id}}</button>                
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{url('bookingorder/view/'.$row->id)}}">View order </a></li>
                                            @if ($row->parcel_status=="Pending" && Auth::user()->user_type_id==2)
                                            <li><a class="dropdown-item" href="{{url('bookingorder/edit/'.$row->id)}}">Modify</a></li>
                                            <li><a class="dropdown-item" href="{{url('bookingorder/delete/'.$row->id)}}">Delete</a></li>
                                            @elseif(Auth::user()->user_type_id==1)
                                            <li><a class="dropdown-item" href="{{url('bookingorder/edit/'.$row->id)}}">Modify</a></li>
                                            <li><a class="dropdown-item" href="{{url('bookingorder/delete/'.$row->id)}}">Delete</a></li>
                                            @endif
                                          </ul>
                                        </div>
                                          <a class="btn" target="_blank" href="{{url('bookingorder/pdf/'.$row->id)}}"><i class="fas fa-print"> PDF</i></a>
                                      </div>
                                    </td>
                                    <td class="text-center">{{$row->full_name}}</td>
                                    <td class="text-center">{{$row->mobile}}</td>
                                    <td class="text-center">{{$row->business_name}}</td>
                                    <td class="text-center">{{$row->sending_type_name}}</td>
                                    <td class="text-center">{{$row->recipient_number}}</td>
                                    <td class="text-center">{{$row->recipient_number_two}}</td>
                                    <td class="text-center">{{$row->recipient_name}}</td>
                                    <td class="text-center">{{$row->special_note}}</td>
                                    <td class="text-center">{{$row->recipient_city_name}}</td>
                                    <td class="text-center">{{$row->recipient_area_area_name}}</td>
                                    <td class="text-center">{{$row->address}}</td>
                                    <td class="text-center">{{$row->landmarks}}</td>
                                    <td class="text-center">{{$row->pickup_address}}</td>
                                    <td class="text-center">{{$row->product_id}}</td>
                                    <td class="text-center">{{$row->parcel_type_name}}</td>
                                    <td class="text-center">{{$row->delivery_type_name}}</td>
                                    <td class="text-center">{{$row->package_id_name}}</td>
                                    <td class="text-center">{{$row->product_price}}</td>
                                    <td class="text-center">{{$row->payment_method_name}}</td>
                                    <td class="text-center">{{$row->deliver_date}}</td>
                                    <td class="text-center">{{$row->no_of_items}}</td>
                                    <td class="text-center">{{$row->parcel_status}}</td>
                                    <td class="text-center">
                                      @if ($row->parcel_status=="Delivered")
                                        {{$row->payment_status}}
                                      @else
                                        Not Delivered Yet
                                      @endif
                                    </td>
                                    <td>{{formatDateTime($row->created_at)}}</td>
                                
                                </tr>
                            @endforeach
                        @endif
                                        
                    </tbody>
                    <tfoot>
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
                    </tfoot>
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

@section("js")
    @include("admin.include.lib.datatable.js")
@endsection
        