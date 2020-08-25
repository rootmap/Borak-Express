
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
              <li class="breadcrumb-item active">View Order</li>
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
            <h3 class="card-title">View Booking Order</h3>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Sending Type</label>
                                      <input disabled type="text" 
                                            
                                        <?php 
                                        if(isset($dataRow->sending_type_name)){
                                            ?>
                                            value="{{$dataRow->sending_type_name}}" 
                                            <?php 
                                        }
                                        ?>
                                        
                                        class="form-control" placeholder="Enter Recipient Number">
                                    </div>
                                </div>
          
                                <div class="col-sm-4">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label for="recipient_number">Recipient Number</label>
                                    <input disabled type="text" 
                                        
                                    <?php 
                                    if(isset($dataRow->recipient_number)){
                                        ?>
                                        value="{{$dataRow->recipient_number}}" 
                                        <?php 
                                    }
                                    ?>
                                    
                                    class="form-control" placeholder="Enter Recipient Number" id="recipient_number" name="recipient_number">
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <!-- text input -->
                                  <div class="form-group">
                                    <label for="recipient_number">Recipient Second Number</label>
                                    <input disabled type="text" 
                                        
                                    <?php 
                                    if(isset($dataRow->recipient_number_two)){
                                        ?>
                                        value="{{$dataRow->recipient_number_two}}" 
                                        <?php 
                                    }
                                    ?>
                                    
                                    class="form-control" placeholder="Enter Recipient Second Number" id="recipient_number_two" name="recipient_number_two">
                                  </div>
                                </div>
          
                                
                            </div>
                    
                            
                            <div class="row">
                              <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="recipient_name">Recipient Name</label>
                                  <input disabled type="text" 
                                      
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
                                      <select disabled class="form-control select2" style="width: 100%;"  id="recipient_city" name="recipient_city">
                                        
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
                                      <select disabled class="form-control select2" style="width: 100%;"  id="recipient_area" name="recipient_area">
                                        
                                            <option value="">Please Select</option>
                                            @if(count($dataRow_BookingArea)>0)
                                                @foreach($dataRow_BookingArea as $BookingArea)
                                                    <option 
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
                                  <textarea disabled class="form-control" rows="3"  placeholder="Enter Address" id="address" name="address"><?php 
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
                                  <textarea disabled class="form-control" rows="3"  placeholder="Enter Recipient Area" id="landmarks" name="landmarks"><?php 
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
                                  <input disabled type="text" 
                                      
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
                                    <select disabled class="form-control select2" style="width: 100%;"  id="parcel_type" name="parcel_type">
                                      
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
                                    <label>Delivery Type</label>
                                    <select disabled class="form-control select2" style="width: 100%;"  id="delivery_type" name="delivery_type">
                                      
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
                                    <label>Package Name</label>
                                    <select disabled class="form-control select2" style="width: 100%;"  id="package_id" name="package_id">
                                      
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
                                  <input disabled type="text" 
                                      
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
          
                              <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="product_price">Product Payment </label>
                                  <input disabled type="text" 
                                      
                                  <?php 
                                  if(isset($dataRow->payment_method_name)){
                                      ?>
                                      value="{{$dataRow->payment_method_name}}" 
                                      <?php 
                                  }
                                  ?>
                                  
                                  class="form-control" placeholder="Enter Product Price" id="payment_method_name" name="payment_method_name">
                                </div>
                              </div>
          
                          </div>
                          
                          <div class="row">
                              <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                  <label for="deliver_date">Deliver Date</label>
                                  <input disabled type="text" 
                                      
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
                                  <input disabled type="text" 
                                      
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
                              <input disabled type="hidden" 
                                      
                                  <?php 
                                  if(isset($dataRow->shipping_cost)){
                                      ?>
                                      value="{{$dataRow->shipping_cost}}" 
                                      <?php 
                                  }
                                  ?>
                                  
                                  class="form-control" placeholder="Enter shipping_cost" id="shipping_cost" name="shipping_cost">
                              
                                  <input disabled type="hidden" 
                                      
                                  <?php 
                                  if(isset($dataRow->total_charge)){
                                      ?>
                                      value="{{$dataRow->total_charge}}" 
                                      <?php 
                                  }
                                  ?>
                                  
                                  class="form-control" placeholder="Enter total_charge" id="total_charge" name="total_charge">
                                
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
                                            <input disabled class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
                                            <input disabled  class="form-check-input" type="radio"  
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
              
              
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <a class="btn btn-danger" href="{{url('bookingorder')}}">
                <i class="far fa-times-circle"></i> 
                Go Back to list
              </a>
              @if($dataRow->parcel_status=="Pending" || Auth::user()->user_type_id==1)
              <a class="btn btn-info" href="{{url('bookingorder/edit/'.$dataRow->id)}}">
                <i class="far fa-edit"></i> 
                Edit Order
              </a>
              @endif
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
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
      function cart_sum(){
        var totalSC=0;
        $('.cart_sum').each(function(k,r){
            console.log($(r).html());
            totalSC+=parseFloat($(r).html())-0;
        });

        $("#total_cart_sum").html(totalSC);
    }
    $(document).ready(function(){
      cart_sum();
        $(".select2").select2();
    });
    </script>

@endsection
        