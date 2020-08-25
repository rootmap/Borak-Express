
@extends("admin.layout.master")
@section("title","Edit Booking Order")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Booking Order</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bookingorder/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('bookingorder/create')}}">Create New </a></li>
              <li class="breadcrumb-item active">Edit / Modify</li>
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
            <h3 class="card-title">Edit / Modify Booking Order</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('bookingorder/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('bookingorder/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
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
          <form action="{{url('bookingorder/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
              
              <div class="row">
                  <div class="col-md-8">
                    <fieldset>
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
                            <label>Choose Merchant</label>
                            <select class="form-control select2" style="width: 100%;"  id="merchant_id" name="merchant_id">
                                  <option value="">Please Select</option>
                                  @if(isset($dataRow_MerchantInfo))    
                                      @if(count($dataRow_MerchantInfo)>0)
                                          @foreach($dataRow_MerchantInfo as $ItemType)
                                              <option 
                                              @if(isset($dataRow->id))
                                                  @if($dataRow->created_by==$ItemType->user_id)
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
                      </div>
                      @endif
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                <label>Choose Sending Type</label>
                                <select class="form-control select2" style="width: 100%;"  id="sending_type" name="sending_type">
                                  
                                      <option value="">Please Select</option>
                                      @if(count($dataRow_SendingType)>0)
                                          @foreach($dataRow_SendingType as $ItemType)
                                              <option 
                                      @if(isset($dataRow->id))
                                          @if($dataRow->sending_type==$ItemType->id)
                                              selected="selected" 
                                          @endif
                                      @endif 
                                        value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                              
                                          @endforeach
                                      @endif
                                      
                                </select>
                              </div>
                          </div>
    
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="recipient_number">Recipient Mob. No.</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->recipient_number)){
                                  ?>
                                  value="{{$dataRow->recipient_number}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control"   maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  placeholder="Enter Recipient Number" id="recipient_number" name="recipient_number">
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="recipient_number">Recipient Second Mob. No.</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->recipient_number_two)){
                                  ?>
                                  value="{{$dataRow->recipient_number_two}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control"   maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  placeholder="Enter Another Recipient Number" id="recipient_number_two" name="recipient_number_two">
                            </div>
                          </div>
    
                          
                      </div>
              
                      
              
                      <div class="row">
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="recipient_name">Recipient Name</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->recipient_name)){
                                  ?>
                                  value="{{$dataRow->recipient_name}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter Recipient Name" id="recipient_name" name="recipient_name">
                            </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                <label>Choose Recipient City</label>
                                <select class="form-control select2" style="width: 100%;"  id="recipient_city" name="recipient_city">
                                  
                                      <option value="">Please Select</option>
                                      @if(count($dataRow_City)>0)
                                          @foreach($dataRow_City as $City)
                                              <option 
                                      @if(isset($dataRow->id))
                                          @if($dataRow->recipient_city==$City->id)
                                              selected="selected" 
                                          @endif
                                      @endif 
                                        value="{{$City->id}}">{{$City->name}}</option>
                                              
                                          @endforeach
                                      @endif
                                      
                                </select>
                              </div>
                          </div>
                    
                          <div class="col-md-4">
                              <div class="form-group">
                                <label>Choose Recipient Area</label>
                                <select class="form-control select2" style="width: 100%;"  id="recipient_area" name="recipient_area">
                                  
                                      <option value="">Please Select</option>
                                      @if(count($dataRow_BookingArea)>0)
                                          @foreach($dataRow_BookingArea as $BookingArea)
                                              <option  data-charge="{{$BookingArea->shipping_price}}"  
                                      @if(isset($dataRow->id))
                                          @if($dataRow->recipient_area==$BookingArea->id)
                                              selected="selected" 
                                          @endif
                                      @endif 
                                        value="{{$BookingArea->id}}">{{$BookingArea->area_name}}</option>
                                              
                                          @endforeach
                                      @endif
                                      
                                </select>
                              </div>
                          </div>
    
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" rows="3"  placeholder="Enter Address" id="address" name="address"><?php 
                                    if(isset($dataRow->address)){
                                        
                                        echo $dataRow->address;
                                        
                                    }
                                    ?></textarea>
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="landmarks">Landmarks</label>
                            <textarea class="form-control" rows="3"  placeholder="Enter Recipient Area" id="landmarks" name="landmarks"><?php 
                                    if(isset($dataRow->landmarks)){
                                        
                                        echo $dataRow->landmarks;
                                        
                                    }
                                    ?></textarea>
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
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->product_id)){
                                  ?>
                                  value="{{$dataRow->product_id}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter Product ID" id="product_id" name="product_id">
                            </div>
                          </div>
              
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Choose Parcel Type</label>
                                        <select class="form-control select2" style="width: 100%;"  id="parcel_type" name="parcel_type">
                                          
                                              <option value="">Please Select</option>
                                              @if(count($dataRow_ItemType)>0)
                                                  @foreach($dataRow_ItemType as $ItemType)
                                                      <option 
                                              @if(isset($dataRow->id))
                                                  @if($dataRow->parcel_type==$ItemType->id)
                                                      selected="selected" 
                                                  @endif
                                              @endif 
                                              value="{{$ItemType->id}}">{{$ItemType->name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                              
                                        </select>
                                      </div>
                                  </div>
                              
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Choose Delivery Type</label>
                                        <select class="form-control select2" style="width: 100%;"  id="delivery_type" name="delivery_type">
                                          
                                              <option value="">Please Select</option>
                                              @if(count($dataRow_BookingDeliveryType)>0)
                                                  @foreach($dataRow_BookingDeliveryType as $BookingDeliveryType)
                                                      <option 
                                              @if(isset($dataRow->id))
                                                  @if($dataRow->delivery_type==$BookingDeliveryType->id)
                                                      selected="selected" 
                                                  @endif
                                              @endif 
                                              value="{{$BookingDeliveryType->id}}">{{$BookingDeliveryType->name}}</option>
                                                      
                                                  @endforeach
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
                                              @if(count($dataRow_BookingPackage)>0)
                                                  @foreach($dataRow_BookingPackage as $BookingPackage)
                                                      <option 
                                              @if(isset($dataRow->id))
                                                  @if($dataRow->package_id==$BookingPackage->id)
                                                      selected="selected" 
                                                  @endif
                                              @endif 
                                              value="{{$BookingPackage->id}}">{{$BookingPackage->name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                              
                                        </select>
                                      </div>
                                  </div>
                              
                          <div class="col-sm-4">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="product_price">Product Price</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->product_price)){
                                  ?>
                                  value="{{$dataRow->product_price}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter Product Price" id="product_price" name="product_price">
                            </div>
                          </div>
      
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Payment Method</label>
                              <select class="form-control select2" style="width: 100%;"  id="payment_method" name="payment_method">
                                
                                    <option value="">Please Select</option>
                                    @if(count($dataRow_PaymentMethod)>0)
                                        @foreach($dataRow_PaymentMethod as $BookingArea)
                                            <option  data-charge="{{$BookingArea->charge}}"
                                    @if(isset($dataRow->id))
                                        @if($dataRow->payment_method==$BookingArea->id)
                                            selected="selected" 
                                        @endif
                                    @endif 
                                    value="{{$BookingArea->id}}">{{$BookingArea->name}}</option>
                                            
                                        @endforeach
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
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->deliver_date)){
                                  ?>
                                  value="{{$dataRow->deliver_date}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter Deliver Date" id="deliver_date" name="deliver_date">
                            </div>
                          </div>
                      
                          <div class="col-sm-3">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="no_of_items">No of Items</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->no_of_items)){
                                  ?>
                                  value="{{$dataRow->no_of_items}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter No of Items/Quantity" id="no_of_items" name="no_of_items">
                            </div>
                          </div>
                          <input type="hidden" 
                                  
                              <?php 
                              if(isset($dataRow->shipping_cost)){
                                  ?>
                                  value="{{$dataRow->shipping_cost}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" readonly placeholder="Enter shipping_cost" id="shipping_cost" name="shipping_cost">
                           
                          
                              <input type="hidden" 
                                  
                              <?php 
                              if(isset($dataRow->total_charge)){
                                  ?>
                                  value="{{$dataRow->total_charge}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" readonly placeholder="Enter total_charge" id="total_charge" name="total_charge">
                            
                      </div>
                      
                      @if (Auth::user()->user_type_id==2)
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="deliver_date">Parcel Status</label>
                            <input type="text" disabled
                                
                            <?php 
                            if(isset($dataRow->parcel_status)){
                                ?>
                                value="{{$dataRow->parcel_status}}" 
                                <?php 
                            }
                            ?>
                            
                            class="form-control" placeholder="Enter Deliver Date">
                          </div>
                        </div>
                      </div>
      
                      @if ($dataRow->parcel_status=="Delivered")
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label for="deliver_date">Payment Status</label>
                            <input type="text" disabled
                                
                            <?php 
                            if(isset($dataRow->payment_status)){
                                ?>
                                value="{{$dataRow->payment_status}}" 
                                <?php 
                            }
                            ?>
                            
                            class="form-control" placeholder="Enter payment_status">
                          </div>
                        </div>
                      @endif
                      
      
      
                      @else
                      
      
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- radio -->
                            <div class="form-group">
                            <label>Choose Parcel Status</label>
                
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Pending"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_0" name="parcel_status" value="Pending">
                                  <label class="form-check-label">Pending</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Accepted"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_1" name="parcel_status" value="Accepted">
                                  <label class="form-check-label">Accepted</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Pickup"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_2" name="parcel_status" value="Pickup">
                                  <label class="form-check-label">Pickup</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="On The Way"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_3" name="parcel_status" value="On The Way">
                                  <label class="form-check-label">On The Way</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Delivered"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_4" name="parcel_status" value="Delivered">
                                  <label class="form-check-label">Delivered</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Cancel"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
                                  id="parcel_status_5" name="parcel_status" value="Cancel">
                                  <label class="form-check-label">Cancel</label>
                                </div>
                        
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  
                                        <?php 
                                        if($dataRow->parcel_status=="Hold"){
                                            ?>
                                            checked="checked" 
                                            <?php 
                                        }
                                        ?>
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
                                            <?php 
                                            if($dataRow->payment_status=="Paid"){
                                                ?>
                                                checked="checked" 
                                                <?php 
                                            }
                                            ?>
                                      id="payment_status_0" name="payment_status" value="Paid">
                                      <label class="form-check-label">Paid</label>
                                    </div>
                            
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"  
                                            <?php 
                                            if($dataRow->payment_status=="Unpaid"){
                                                ?>
                                                checked="checked" 
                                                <?php 
                                            }
                                            ?>
                                      id="payment_status_1" name="payment_status" value="Unpaid">
                                      <label class="form-check-label">Unpaid</label>
                                    </div>
                            
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"  
                                            <?php 
                                            if($dataRow->payment_status=="Processing"){
                                                ?>
                                                checked="checked" 
                                                <?php 
                                            }
                                            ?>
                                      id="payment_status_2" name="payment_status" value="Processing">
                                      <label class="form-check-label">Processing</label>
                                    </div>
                            
                                </div>
                            </div>
      
                      </div>
                      @endif
                    </fieldset>
                  </div>
                  <div class="col-md-4">
                      <!-- start cart-->
                      <div class="card card-warning card-outline position-sticky" 
                                    {{-- style="position: absolute; bottom:20px; width:90%; left:20px;" --}}
                                    >
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
                                                      <td class="shipping_cost_cart cart_sum" id="shipping_cost_cart">{{$dataRow->shipping_cost}}</td>
                                                  </tr>
                                                  <tr>
                                                      <td>COD</td>
                                                      <td class="shipping_cost_cart cart_sum" id="codbod_cost_cart">{{$dataRow->total_charge}}</td>
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
                      <!--end cart-->
                  </div>
              </div>
              
              
                   
            
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('bookingorder/edit/'.$dataRow->id)}}">
                <i class="far fa-times-circle"></i> 
                Reset
              </a>
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

        var total_shipping_and_shiping_charge=(product_price-0)+(shipping_cost-0);
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
      cart_sum();
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
        