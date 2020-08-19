
@extends("admin.layout.master")
@section("title","Create New Booking Order")
@section("content")
@if(auth()->guest())
    <script type="text/javascript">
      window.location.href="{{url('login')}}";
    </script>
    <?php 
    dd(1);
    ?>
  @endif
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Booking Order</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bookingorder/list')}}">Booking Order Data</a></li>
              <li class="breadcrumb-item active">Create New Booking Order</li>
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
<section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New Booking Order</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('bookingorder/list')}}"> Data <i class="fas fa-table"></i></a></li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('bookingorder/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('bookingorder/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('bookingorder')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                        <fieldset>
                          <div class="row">
                            <div class="col-md-12">
                              <h6>
                                  Customer Information
                              </h6>
                              <hr>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Choose Sending Type</label>
                                    <select class="form-control select2" style="width: 100%;"  id="sending_type" name="sending_type">
                                          <option value="">Please Select</option>
                                          @if(isset($dataRow_SendingType))    
                                              @if(count($dataRow_SendingType)>0)
                                                  @foreach($dataRow_SendingType as $ItemType)
                                                      <option value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                          @endif 
                                          
                                    </select>
                                  </div>
                              </div>

                              <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="recipient_number">Recipient Mob. No.</label>
                                  <input type="text" class="form-control" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Recipient Number" id="recipient_number" name="recipient_number">
                                </div>
                              </div>
                              <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="recipient_number">Recipient Second Mob. No</label>
                                  <input type="text" class="form-control" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Recipient Number" id="recipient_number_two" name="recipient_number_two">
                                </div>
                              </div>

                              <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="recipient_name">Recipient Name</label>
                                  <input type="text" class="form-control" placeholder="Enter Recipient Name" id="recipient_name" name="recipient_name">
                                </div>
                              </div>
                          </div>
                          
                          <div class="row">
                              <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="address">Address</label>
                                  <textarea class="form-control" rows="3"  placeholder="Enter Address" id="address" name="address"></textarea>
                                </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Choose Recipient City</label>
                                    <select class="form-control select2" style="width: 100%;"  id="recipient_city" name="recipient_city">
                                          <option value="">Please Select</option>
                                          @if(isset($dataRow_City))    
                                              @if(count($dataRow_City)>0)
                                                  @foreach($dataRow_City as $City)
                                                      <option value="{{$City->id}}">{{$City->name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                          @endif 
                                          
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Choose Recipient Area</label>
                                    <select class="form-control select2" style="width: 100%;"  id="recipient_area" name="recipient_area">
                                          <option value="">Please Select</option>
                                          @if(isset($dataRow_BookingArea))    
                                              @if(count($dataRow_BookingArea)>0)
                                                  @foreach($dataRow_BookingArea as $BookingArea)
                                                      <option data-charge="{{$BookingArea->shipping_price}}" value="{{$BookingArea->id}}">{{$BookingArea->area_name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                          @endif 
                                          
                                    </select>
                                  </div>
                              </div>
                          </div>
                      
                          <div class="row">
                              <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="landmarks">Landmarks</label>
                                  <textarea class="form-control" rows="3"  placeholder="Enter Recipient Area" id="landmarks" name="landmarks"></textarea>
                                </div>
                              </div>

                          </div>
                        </fieldset>

                        <fieldset>
                          <div class="row">
                            <div class="col-md-12">
                              <h6>
                                  Percel Information
                              </h6>
                              <hr>
                            </div>
                          </div>
                          <div class="row">
  
                            <div class="col-sm-4">
                              <!-- text input -->
                              <div class="form-group">
                                <label for="product_id">Product ID</label>
                                <input type="text" class="form-control" placeholder="Enter Product ID" id="product_id" name="product_id">
                              </div>
                            </div>

                            <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Choose Parcel Type</label>
                                      <select class="form-control select2" style="width: 100%;"  id="parcel_type" name="parcel_type">
                                            <option value="">Please Select</option>
                                            @if(isset($dataRow_ItemType))    
                                                @if(count($dataRow_ItemType)>0)
                                                    @foreach($dataRow_ItemType as $ItemType)
                                                        <option value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                        
                                                    @endforeach
                                                @endif
                                            @endif 
                                            
                                      </select>
                                    </div>
                                </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Choose Delivery Type</label>
                                  <select class="form-control select2" style="width: 100%;"  id="delivery_type" name="delivery_type">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_BookingDeliveryType))    
                                            @if(count($dataRow_BookingDeliveryType)>0)
                                                @foreach($dataRow_BookingDeliveryType as $BookingDeliveryType)
                                                    <option value="{{$BookingDeliveryType->id}}">{{$BookingDeliveryType->name}}</option>
                                                    
                                                @endforeach
                                            @endif
                                        @endif 
                                        
                                  </select>
                                </div>
                            </div>

                          </div>
                          <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Choose Package Name</label>
                                  <select class="form-control select2" style="width: 100%;"  id="package_id" name="package_id">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_BookingPackage))    
                                            @if(count($dataRow_BookingPackage)>0)
                                                @foreach($dataRow_BookingPackage as $BookingPackage)
                                                    <option value="{{$BookingPackage->id}}">{{$BookingPackage->name}}</option>
                                                    
                                                @endforeach
                                            @endif
                                        @endif 
                                        
                                  </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                              <!-- text input -->
                              <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" class="form-control"  maxlength="13"   placeholder="Enter Product Price" id="product_price" name="product_price" value="0">
                              </div>
                            </div>

                            <div class="col-sm-4">
                              <!-- text input -->
                              <div class="form-group">
                                <label for="product_price">Product Payment</label>
                                <select class="form-control select2" style="width: 100%;"  id="payment_method" name="payment_method">
                                      <option value="">Please Select</option>
                                      @if(isset($dataRow_PaymentMethod))    
                                          @if(count($dataRow_PaymentMethod)>0)
                                              @foreach($dataRow_PaymentMethod as $BookingPackage)
                                                  <option data-charge="{{$BookingPackage->charge}}" value="{{$BookingPackage->id}}">{{$BookingPackage->name}} - {{$BookingPackage->charge}}%</option>
                                              @endforeach
                                          @endif
                                      @endif 
                                </select>
                              </div>
                            </div>

                          </div>
                
                          <div class="row">
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="deliver_date">Deliver Date</label>
                                  <input type="text" class="form-control deliverdate" placeholder="Enter Deliver Date" id="deliver_date" name="deliver_date">
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="no_of_items">No of Items</label>
                                  <input type="text" class="form-control" placeholder="Enter No of Items/Quantity" id="no_of_items" name="no_of_items">
                                </div>
                              </div>

                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="product_price">Shipping Cost</label>
                                  <input type="text" readonly class="form-control" value="0" placeholder="Enter shipping cost" id="shipping_cost" name="shipping_cost">
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="product_price">Total Charge</label>
                                  <input type="text" readonly class="form-control" value="0" placeholder="Enter shipping cost" id="total_charge" name="total_charge">
                                </div>
                              </div>

                          </div>

                          @if(Auth::user()->user_type_id==2)
                            
                          @else 
                          <div class="row">
                            <div class="col-sm-4">
                              <!-- radio -->
                              <div class="form-group">
                              <label>Choose Parcel Status</label>
                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_0" name="parcel_status" value="Pending">
                                          <label class="form-check-label">Pending</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_1" name="parcel_status" value="Accepted">
                                          <label class="form-check-label">Accepted</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_2" name="parcel_status" value="Pickup">
                                          <label class="form-check-label">Pickup</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_3" name="parcel_status" value="On The Way">
                                          <label class="form-check-label">On The Way</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_4" name="parcel_status" value="Delivered">
                                          <label class="form-check-label">Delivered</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_5" name="parcel_status" value="Cancel">
                                          <label class="form-check-label">Cancel</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="parcel_status_6" name="parcel_status" value="Hold">
                                          <label class="form-check-label">Hold</label>
                                        </div>
                                
                                    </div>
                                </div>

                            <div class="col-sm-4">
                              <!-- radio -->
                              <div class="form-group">
                              <label>Choose Payment Status</label>
                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="payment_status_0" name="payment_status" value="Paid">
                                          <label class="form-check-label">Paid</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="payment_status_1" name="payment_status" value="Unpaid">
                                          <label class="form-check-label">Unpaid</label>
                                        </div>
                                
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                          id="payment_status_2" name="payment_status" value="Processing">
                                          <label class="form-check-label">Processing</label>
                                        </div>
                                
                                    </div>
                                </div>
                            </div>
                          @endif
                
                          <code>Order Notes : After you submit your order you can modify or delete before 5 PM</code>

                        </fieldset>
                                    
                    </div>
                          
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('bookingorder/create')}}"><i class="far fa-times-circle"></i> Reset</a>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section("css")
    
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
      <!-- daterange picker -->
    <link rel="stylesheet" href="{{url('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endsection
        
@section("js")
    <!-- date-range-picker -->
    <script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
    
    <!-- InputMask -->
    <script src="{{url('admin/plugins/moment/moment.min.js')}}"></script>
    <script src="{{url('admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{url('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>

    var recipient_area=<?=json_encode($dataRow_BookingArea)?>;
    var payment_method=<?=json_encode($dataRow_PaymentMethod)?>;

    $('.deliverdate').daterangepicker({
      timePicker: true,
      singleDatePicker: true,
      timePicker: false,
      minDate: moment(),
      locale: {
        format: 'YYYY-MM-DD'
      }
    });

    $("#product_price").keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));   
        $("select[name=payment_method]").change();     
        $("select[name=recipient_area]").change();     
    });

    $(document).ready(function(){

        $("select[name=payment_method]").change(function(){
            var payment_method_id=$(this).val();
            var area_charge=0;
            $.each(payment_method,function(key,row){
                if(row.id==payment_method_id)
                {
                    area_charge=row.charge;
                }
            });
            console.log('charge =',area_charge);
            var product_price=$("input[name=product_price]").val();
            var shipping_cost=$("input[name=shipping_cost]").val();

            var total_shipping_and_shiping_charge=(product_price-0)+(shipping_cost-0);
            var total_charge=parseFloat((parseFloat(total_shipping_and_shiping_charge)*parseFloat(area_charge))/100);
            console.log(total_charge);
            $('input[name=total_charge]').val(total_charge);
        });

        $("select[name=recipient_area]").change(function(){
          var recipient_area_id=$(this).val();
          var area_charge=0;
          $.each(recipient_area,function(key,row){
              if(row.id==recipient_area_id)
              {
                  area_charge=row.shipping_price;
              }
          });

          $("input[name=shipping_cost]").val(area_charge);
          $("#payment_method").change();
        });

        $(".select2").select2();
    });

    
    </script>

@endsection
        