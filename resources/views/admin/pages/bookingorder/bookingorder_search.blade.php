
@extends("admin.layout.master")
@section("title","Booking Order")
@section("content")
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-12">
                <h1 align="center"><i class="fas fa-search"></i> Search Your Booking Order</h1>
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
                      <h3 class="card-title"><i class="fa fa-filter"></i> Filter Booking Order</h3>
                    </div>
    
    
                    
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{url('order/search')}}" id="filter" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="recipient_name">Search [id/mobile/recipient]</label>
                                        <input type="text" class="form-control" 
                                        @isset($search)
                                            @if(!empty($search))
                                            value="{{$search}}"
                                            @endif
                                        @endisset
                                        
                                        placeholder="Enter Recipient Name" id="search" name="search">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Choose Order Status</label>
                                        <select class="form-control select2" style="width: 100%;"  id="status" name="status">
                                                <option 
                                                @isset($status)
                                                    @if($status=="")
                                                        selected="selected"
                                                    @endif
                                                @endisset
                                                value="">Please Select</option>                                                
                                                <option 
                                                @isset($status)
                                                    @if($status=="Pending")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Pending">Pending</option>                                                
                                                <option 
                                                @isset($status)
                                                    @if($status=="Accepted")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Accepted">Accepted</option>                                                
                                                <option 
                                                @isset($status)
                                                    @if($status=="Picked up")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Picked up">Picked up</option>
                                                <option 
                                                @isset($status)
                                                    @if($status=="On The Way")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="On The Way">On The Way</option>                                                
                                                <option 
                                                @isset($status)
                                                    @if($status=="Delivered")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Delivered">Delivered</option>                                                
                                                <option 
                                                @isset($status)
                                                    @if($status=="Canceled")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Canceled">Canceled</option>
                                                <option 
                                                @isset($status)
                                                    @if($status=="Hold")
                                                        selected="selected"
                                                    @endif
                                                @endisset 
                                                value="Hold">Hold</option>
                                            <option
                                                    @isset($status)
                                                    @if($status=="Returned")
                                                    selected="selected"
                                                    @endif
                                                    @endisset
                                                    value="Returned">Returned</option>
                                        </select>
                                    </div>
                                </div>
                               
                                
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="recipient_name">Start Date</label>
                                        <input type="text" class="form-control deliverdate" value="{{$start_date}}" placeholder="Enter Start Date Date" name="start_date">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="recipient_name">End Date</label>
                                        <input type="text" class="form-control deliverdate" value="{{$end_date}}" placeholder="Enter End  Date" name="end_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              @if (Auth::user()->user_type_id==1)
                              <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Choose Merchant</label>
                                    <select class="form-control select2" style="width: 100%;"  id="merchant_id" name="merchant_id">
                                      <option value="">Please Select</option>
                                      @if(isset($merchant))    
                                          @if(count($merchant)>0)
                                              @foreach($merchant as $ItemType)
                                                  <option 
                                                  @if(isset($merchant_id))
                                                      @if($merchant_id==$ItemType->user_id)
                                                          selected="selected" 
                                                      @endif
                                                  @endif 
                                                  value="{{$ItemType->user_id}}">{{$ItemType->full_name}}, {{$ItemType->email}}, {{$ItemType->mobile}}, {{$ItemType->business_name}}</option>
                                                  
                                              @endforeach
                                          @endif
                                      @endif 
                                      
                                </select>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Choose Deliver City</label>
                                    <select class="form-control select2" style="width: 100%;"  id="city_id" name="city_id">
                                      <option value="">Please Select</option>
                                      @if(isset($city))    
                                          @if(count($city)>0)
                                              @foreach($city as $ItemType)
                                                  <option 
                                                  @if(isset($city_id))
                                                      @if($city_id==$ItemType->id)
                                                          selected="selected" 
                                                      @endif
                                                  @endif 
                                                  value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                  
                                              @endforeach
                                          @endif
                                      @endif 
                                      
                                </select>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Choose Delivery Area</label>
                                    <select class="form-control select2" style="width: 100%;"  id="area_id" name="area_id">
                                      <option value="">Please Select</option>
                                      @if(!empty($area_id))
                                        @if(isset($deliver_area))    
                                            @if(count($deliver_area)>0)
                                                @foreach($deliver_area as $ItemType)
                                                    <option 
                                                    
                                                        @if($area_id==$ItemType->id)
                                                            selected="selected" 
                                                        @endif
                                                    
                                                    value="{{$ItemType->id}}">{{$ItemType->area_name}}</option>
                                                @endforeach
                                            @endif
                                        @endif 
                                      @endif 
                                </select>
                                </div>
                              </div>
                              @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info" id="search"><i class="fas fa-search"></i> Search</button>
                                    <a href="javascript:void(0);" data-url="{{url('order/export/excel')}}" class="btn btn-info export"><i class="fas fa-file-excel"></i> Export Excel</a>
                                    <a href="javascript:void(0);" data-url="{{url('order/export/pdf')}}" class="btn btn-info export"><i class="fas fa-file-pdf"></i> Export PDF</a>
                                    <a href="{{url('order/search')}}"  class="btn btn-danger"><i class="fas fa-trash"></i> Clear Search</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
                <!-- /.col -->
              </div>


          <div class="row">
            <div class="col-12">
              <!-- /.card -->
              <div class="card">

                <div class="card-header">
                  <h3 class="card-title"><i class="fa fa-chart-pie"></i> Booking Order Search Result</h3>
                </div>


                
                <!-- /.card-header -->
                <div class="card-body" style="overflow: scroll;">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Tracking ID</th>
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
                                            @if ($row->parcel_status=="Pending")
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
                        <th class="text-center">Tracking ID</th>
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
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endsection

@section("js")
    @include("admin.include.lib.datatable.js")
    <!-- date-range-picker -->
    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    <script src="{{url('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{url('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script>
        var recipient_area=<?=json_encode($deliver_area)?>;
        $('.deliverdate').daterangepicker({
          timePicker: true,
          singleDatePicker: true,
          timePicker: false,
          locale: {
            format: 'YYYY-MM-DD'
          }
        });   

        $(document).ready(function(){
            $('#city_id').change(function(){
              var delivery_city=$(this).val();
              var area_html='<option value="">Select Delivery Area</option>';
              if(delivery_city.length > 0)
              {
                  $.each(recipient_area,function(index,row){
                      if(row.city_id==delivery_city)
                      {
                          area_html+='<option value="'+row.id+'">'+row.area_name+'</option>';
                      }
                  });
              }


              $("#area_id").html(area_html);
              $("#area_id").select2();
            });
            $(".select2").select2();
            $(".export").click(function(){
                var data_url=$(this).attr('data-url');
                $("#filter").attr('action',data_url)
                $("#filter").submit();
                $("#filter").attr('action','search')
            });
        });
    </script>
@endsection
