
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
        <div class="card card-primary bg_transparent border-0">
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

                        <div class="card p-3">
                          
                          
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6>
                                        Customer Information
                                    </h6>
                                    <hr>
                                  </div>
                                </div>
                                
                                    @if (Auth::user()->user_type_id==1)
                                    <div class="row">
                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="star-after">Choose Merchant</label>
                                          <select class="form-control select2" style="width: 100%;"  id="merchant_id" name="merchant_id">
                                                <option value="">Please Select</option>
                                                @if(isset($dataRow_MerchantInfo))    
                                                    @if(count($dataRow_MerchantInfo)>0)
                                                        @foreach($dataRow_MerchantInfo as $ItemType)
                                                            <option 
                                                            @if(!empty(old('merchant_id')))
                                                              {{old('merchant_id')==$ItemType->user_id?' selected="selected" ':''}}
                                                            @endif 
                                                            value="{{$ItemType->user_id}}">{{$ItemType->full_name}}, {{$ItemType->email}}, {{$ItemType->mobile}}, {{$ItemType->business_name}}</option>
                                                            
                                                        @endforeach
                                                    @endif
                                                @endif 
                                                
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="star-after">Choose Sending Type</label>
                                          <select class="form-control select2" style="width: 100%;"  id="sending_type" name="sending_type">
                                                <option value="">Please Select</option>
                                                @if(isset($dataRow_SendingType))    
                                                    @if(count($dataRow_SendingType)>0)
                                                        @foreach($dataRow_SendingType as $ItemType)
                                                            <option 
                                                            @if(!empty(old('sending_type')))
                                                              {{old('sending_type')==$ItemType->id?' selected="selected" ':''}}
                                                            @endif 
                                                            value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                            
                                                        @endforeach
                                                    @endif
                                                @endif 
                                                
                                          </select>
                                        </div>
                                    </div>
      
                                    <div class="col-sm-4">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="star-after" for="recipient_number">Recipient Mob. No.</label>
                                        <input type="text" class="form-control" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Recipient Number" id="recipient_number" name="recipient_number"  value="{{ old('recipient_number') }}" >
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label for="recipient_number">Recipient Second Mob. No</label>
                                        <input type="text" class="form-control" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Recipient Number" id="recipient_number_two" name="recipient_number_two"  value="{{ old('recipient_number_two') }}" >
                                      </div>
                                    </div>
      
                                    
                                </div>
                                
                                <div class="row">
                                  <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label class="star-after" for="recipient_name">Recipient Name</label>
                                      <input type="text" class="form-control" placeholder="Enter Recipient Name" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}">
                                    </div>
                                  </div>
                                    
      
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="star-after">Choose Recipient City</label>
                                          <select class="form-control select2" style="width: 100%;"  id="recipient_city" name="recipient_city">
                                                <option value="">Please Select</option>
                                                @if(isset($dataRow_City))    
                                                    @if(count($dataRow_City)>0)
                                                        @foreach($dataRow_City as $City)
                                                            <option 
                                                            @if(!empty(old('recipient_city')))
                                                              {{old('recipient_city')==$City->id?' selected="selected" ':''}}
                                                            @endif 
                                                            value="{{$City->id}}">{{$City->name}}</option>
                                                            
                                                        @endforeach
                                                    @endif
                                                @endif 
                                                
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="star-after">Choose Recipient Area</label>
                                          <select class="form-control select2" style="width: 100%;"  id="recipient_area" name="recipient_area">
                                                <option value="">Please Select</option>
                                                @if(isset($dataRow_BookingArea))    
                                                    @if(count($dataRow_BookingArea)>0)
                                                        @foreach($dataRow_BookingArea as $BookingArea)
                                                            <option 
                                                            @if(!empty(old('recipient_area')))
                                                              {{old('recipient_area')==$BookingArea->id?' selected="selected" ':''}}
                                                            @endif 
                                                            data-charge="{{$BookingArea->shipping_price}}" value="{{$BookingArea->id}}">{{$BookingArea->area_name}}</option>
                                                            
                                                        @endforeach
                                                    @endif
                                                @endif 
                                                
                                          </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                  <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label class="star-after" for="address">Address</label>
                                      <textarea class="form-control" rows="3"  placeholder="Enter Address" id="address" name="address">{{ old('address') }}</textarea>
                                    </div>
                                  </div>
                                    <div class="col-sm-6">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label for="landmarks">Landmarks</label>
                                        <textarea class="form-control" rows="3"  placeholder="Enter Recipient Area" id="landmarks" name="landmarks">{{ old('landmarks') }}</textarea>
                                      </div>
                                    </div>
      
                                </div>


                        </div>


                            <div class="card p-3">
                            <div class="row">
                                  <div class="col-md-12">
                                    <h6>
                                        Parcel Information
                                    </h6>
                                    <hr>
                                  </div>
                                </div>
                                <div class="row">
  
                                  <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label for="product_id">Product ID</label>
                                      <input type="text" class="form-control" placeholder="Enter Product ID" id="product_id" name="product_id" value="{{ old('product_id') }}">
                                    </div>
                                  </div>
      
                                  <div class="col-md-4">
                                          <div class="form-group">
                                            <label class="star-after">Choose Parcel Type</label>
                                            <select class="form-control select2" style="width: 100%;"  id="parcel_type" name="parcel_type">
                                                  <option value="">Please Select</option>
                                                  @if(isset($dataRow_ItemType))    
                                                      @if(count($dataRow_ItemType)>0)
                                                          @foreach($dataRow_ItemType as $ItemType)
                                                              <option 
                                                              @if(!empty(old('parcel_type')))
                                                                {{old('parcel_type')==$ItemType->id?' selected="selected" ':''}}
                                                              @endif 
                                                              value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                              
                                                          @endforeach
                                                      @endif
                                                  @endif 
                                                  
                                            </select>
                                          </div>
                                      </div>
      
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="star-after">Choose Delivery Type</label>
                                        <select class="form-control select2" style="width: 100%;"  id="delivery_type" name="delivery_type">
                                              <option value="">Please Select</option>
                                              @if(isset($dataRow_BookingDeliveryType))    
                                                  @if(count($dataRow_BookingDeliveryType)>0)
                                                      @foreach($dataRow_BookingDeliveryType as $BookingDeliveryType)
                                                          <option 
                                                          @if(!empty(old('delivery_type')))
                                                            {{old('delivery_type')==$BookingDeliveryType->id?' selected="selected" ':''}}
                                                          @endif 
                                                          value="{{$BookingDeliveryType->id}}">{{$BookingDeliveryType->name}}</option>
                                                          
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
                                        <label class="star-after">Choose Package Name</label>
                                        <select class="form-control select2" style="width: 100%;"  id="package_id" name="package_id">
                                              <option value="">Please Select</option>
                                              @if(isset($dataRow_BookingPackage))    
                                                  @if(count($dataRow_BookingPackage)>0)
                                                      @foreach($dataRow_BookingPackage as $BookingPackage)
                                                          <option 
                                                          @if(!empty(old('package_id')))
                                                            {{old('package_id')==$BookingPackage->id?' selected="selected" ':''}}
                                                          @endif 
                                                          value="{{$BookingPackage->id}}">{{$BookingPackage->name}}</option>
                                                          
                                                      @endforeach
                                                  @endif
                                              @endif 
                                              
                                        </select>
                                      </div>
                                  </div>
      
                                  <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label class="star-after" for="product_price">Product Price </label>
                                      <input type="text" class="form-control"  maxlength="13"   placeholder="Enter Product Price" id="product_price" name="product_price" value="{{ old('product_price')?old('product_price'):'0' }}">
                                      <code>(Please Add Shipping Price with Product Price)</code>
                                    </div>
                                  </div>
      
                                  <div class="col-sm-4">
                                    <!-- text input -->
                                    <div class="form-group">
                                      <label class="star-after" for="product_price">Payment Method</label>
                                      <select class="form-control select2" style="width: 100%;"  id="payment_method" name="payment_method">
                                            <option value="">Please Select</option>
                                            @if(isset($dataRow_PaymentMethod))    
                                                @if(count($dataRow_PaymentMethod)>0)
                                                    @foreach($dataRow_PaymentMethod as $BookingPackage)
                                                        <option 
                                                        @if(!empty(old('payment_method')))
                                                            {{old('payment_method')==$BookingPackage->id?' selected="selected" ':''}}
                                                        @endif 
                                                        data-charge="{{$BookingPackage->charge}}" value="{{$BookingPackage->id}}">{{$BookingPackage->name}}</option>
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
                                        <label for="deliver_date">Deliver Date</label>
                                        <input type="text" class="form-control deliverdate" placeholder="Enter Deliver Date" id="deliver_date" name="deliver_date" value="{{ old('deliver_date') }}">
                                      </div>
                                    </div>
      
                                    <div class="col-sm-4">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="star-after" for="no_of_items">No of Items</label>
                                        <input type="text" class="form-control" placeholder="Enter No of Items/Quantity" id="no_of_items" name="no_of_items" value="{{ old('no_of_items') }}">
                                      </div>
                                    </div>
      
                                    
                                    <input type="hidden" readonly value="0" placeholder="Enter shipping cost" id="shipping_cost" name="shipping_cost" value="{{ old('shipping_cost') }}">
                                    <input type="hidden" readonly value="0" placeholder="Enter shipping cost" id="total_charge" name="total_charge" value="{{ old('total_charge') }}">

                                    @if(Auth::user()->user_type_id==2)
                                            <div class="col-sm-4">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label for="landmarks">Special Note</label>
                                                    <textarea class="form-control" rows="2"  placeholder="Enter Special Notes" id="special_note" name="special_note">{{ old('special_note') }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card card-warning card-outline position-sticky">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-cash-register"></i>
                                                            Cost Management
                                                        </h3>
                                                    </div>
                                                    <div class="card-body" style="padding: 0px;">
                                                        <style type="text/css">
                                                            .shipping_cost_cart::after{
                                                                content: ' Tk';
                                                                text-align: right;
                                                            }
                                                        </style>
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: 59%;">Shipping Cost</td>
                                                                <td class="shipping_cost_cart cart_sum" id="shipping_cost_cart">0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>COD</td>
                                                                <td class="shipping_cost_cart cart_sum" id="codbod_cost_cart">0</td>
                                                            </tr>

                                                            <tr>
                                                                <td style="padding: 0px;" colspan="2"><hr style="margin-top: 0px; margin-bottom: 0px;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Borak Express Cost (+)</td>
                                                                <td class="shipping_cost_cart" id="total_cart_sum">0</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                    @else
                                            <div class="col-sm-4">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label for="landmarks">Special Note</label>
                                                    <textarea class="form-control" rows="2"  placeholder="Enter Special Notes" id="special_note" name="special_note">{{ old('special_note') }}</textarea>
                                                </div>
                                            </div>
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
                                                               id="parcel_status_2" name="parcel_status" value="Picked up">
                                                        <label class="form-check-label">Picked up</label>
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
                                                               id="parcel_status_5" name="parcel_status" value="Canceled">
                                                        <label class="form-check-label">Canceled</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                               id="parcel_status_6" name="parcel_status" value="Hold">
                                                        <label class="form-check-label">Hold</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                               id="parcel_status_6" name="parcel_status" value="Returned">
                                                        <label class="form-check-label">Returned</label>
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

                                            <div class="col-md-4">
                                                <div class="card card-warning card-outline position-sticky">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-cash-register"></i>
                                                            Cost Management
                                                        </h3>
                                                    </div>
                                                    <div class="card-body" style="padding: 0px;">
                                                        <style type="text/css">
                                                            .shipping_cost_cart::after{
                                                                content: ' Tk';
                                                                text-align: right;
                                                            }
                                                        </style>
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: 59%;">Shipping Cost</td>
                                                                <td class="shipping_cost_cart cart_sum" id="shipping_cost_cart">0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>COD</td>
                                                                <td class="shipping_cost_cart cart_sum" id="codbod_cost_cart">0</td>
                                                            </tr>

                                                            <tr>
                                                                <td style="padding: 0px;" colspan="2"><hr style="margin-top: 0px; margin-bottom: 0px;" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Total Borak Express Cost (+)</td>
                                                                <td class="shipping_cost_cart" id="total_cart_sum">0</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>

                                    @endif
                                </div>
                            </div>
      

                              
                          
                
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
    <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">
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
    var ShippingCost_data=<?=json_encode($dataRow_ShippingCost)?>;
    var shipping_area=recipient_area;
    $('.deliverdate').daterangepicker({
      timePicker: true,
      singleDatePicker: true,
      timePicker: false,
      locale: {
        format: 'YYYY-MM-DD'
      }
    });

    $("#product_price").keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));   
        findShippingCost();   
    });

    function cart_sum(){
        var totalSC=0;
        $('.cart_sum').each(function(k,r){
            console.log($(r).html());
            totalSC+=parseFloat($(r).html())-0;
        });

        $("#total_cart_sum").html(totalSC);
    }

    function findShippingCost(){
        var city=$('#recipient_city').val();
        var area=$('#recipient_area').val();
        var delivery_type=$('#delivery_type').val();
        var package_id=$('#package_id').val();

        var shipping_cost = 0;
        $.each(ShippingCost_data,function(index,row){
            if((city==row.delivery_city) && (area==row.delivery_area) && (delivery_type==row.delivery_type) && (package_id==row.package_weight))
            {
                shipping_cost = row.price;
            }
        });

        $("input[name=shipping_cost]").val(shipping_cost);
        $("#shipping_cost_cart").html(shipping_cost);

        var payment_method_id=$("select[name=payment_method]").val();
        var area_charge=0;
        $.each(payment_method,function(key,row){
            if(row.id==payment_method_id)
            {
                area_charge=row.charge;
            }
        });
        console.log('charge =',area_charge);
        $("#codbod_cost_cart").html(0);
        var product_price=$("input[name=product_price]").val();
        var shipping_cost=$("input[name=shipping_cost]").val();

        //var total_shipping_and_shiping_charge=(product_price-0)+(shipping_cost-0);
        var total_shipping_and_shiping_charge=(product_price-0);
        var total_charge=parseFloat((parseFloat(total_shipping_and_shiping_charge)*parseFloat(area_charge))/100);
        console.log(total_charge);
        total_charge = Math.round(total_charge);
        $('input[name=total_charge]').val(total_charge);

        
        $("#codbod_cost_cart").html(total_charge);
            //codbod_cost_cart
            //$("#fragile_charge").html(total_charge);
        
        cart_sum();
        
    }

    $(document).ready(function(){
      findShippingCost();
      $('#recipient_area').change(function(){ findShippingCost(); });
      $('#delivery_type').change(function(){ findShippingCost(); });
      $('#package_id').change(function(){ findShippingCost(); });
      $('#recipient_city').change(function(){
            var delivery_city=$(this).val();
            var area_html='<option value="">Select Delivery Area</option>';
            if(delivery_city.length > 0)
            {
                $.each(shipping_area,function(index,row){
                    if(row.city_id==delivery_city)
                    {
                        area_html+='<option value="'+row.id+'">'+row.area_name+'</option>';
                    }
                });
            }

            $("#recipient_area").html(area_html);
            $("#recipient_area").select2();

            findShippingCost();

        });

        $("select[name=payment_method]").change(function(){
            findShippingCost();
        });

        

        $(".select2").select2();
    });

    
    </script>

@endsection
