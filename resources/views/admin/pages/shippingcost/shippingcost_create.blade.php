
@extends("admin.layout.master")
@section("title","Create New Shipping Cost")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Shipping Cost</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('shippingcost/list')}}">Shipping Cost Data</a></li>
              <li class="breadcrumb-item active">Create New Shipping Cost</li>
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
      <div class="col-md-8 offset-2">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New Shipping Cost</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('shippingcost/list')}}"> Data <i class="fas fa-table"></i></a></li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('shippingcost/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('shippingcost/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('shippingcost')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Choose Delivery Type</label>
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

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Choose Package Weight</label>
                                  <select class="form-control select2" style="width: 100%;"  id="package_weight" name="package_weight">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_BookingPackage))    
                                            @if(count($dataRow_BookingPackage)>0)
                                                @foreach($dataRow_BookingPackage as $BookingPackage)
                                                    <option 
                                                    @if(!empty(old('package_weight')))
                                                        {{old('package_weight')==$BookingPackage->id?' selected="selected" ':''}}
                                                    @endif 
                                                    value="{{$BookingPackage->id}}">{{$BookingPackage->name}}</option>
                                                    
                                                @endforeach
                                            @endif
                                        @endif 
                                        
                                  </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label>Choose Delivery City</label>
                                  <select class="form-control select2" style="width: 100%;"  id="delivery_city" name="delivery_city">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_City))    
                                            @if(count($dataRow_City)>0)
                                                @foreach($dataRow_City as $City)
                                                    <option 
                                                    @if(!empty(old('delivery_city')))
                                                        {{old('delivery_city')==$City->id?' selected="selected" ':''}}
                                                    @endif 
                                                    value="{{$City->id}}">{{$City->name}}</option>
                                                    
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
                                  <label>Choose Delivery Area</label>
                                  <select class="form-control select2" style="width: 100%;"  id="delivery_area" name="delivery_area">
                                        <option value="">Please Select</option>
                                        @if(!empty(old('delivery_city')))
                                          @if(isset($dataRow_BookingArea))    
                                              @if(count($dataRow_BookingArea)>0)
                                                  @foreach($dataRow_BookingArea as $BookingArea)
                                                      <option 
                                                      @if(!empty(old('delivery_area')))
                                                          {{old('delivery_area')==$BookingArea->id?' selected="selected" ':''}}
                                                      @endif 
                                                      value="{{$BookingArea->id}}">{{$BookingArea->area_name}}</option>
                                                      
                                                  @endforeach
                                              @endif
                                          @endif
                                        @endif 
                                        {{--   --}}
                                        
                                  </select>
                                </div>
                            </div>

                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" placeholder="Enter Price" id="price" name="price" value="{{old('price')}}">
                      </div>
                    </div>
 
            <div class="col-sm-4">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Shipping Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                          id="module_status_0" checked name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                          id="module_status_1" name="module_status" value="Inactive">
                          <label class="form-check-label">Inactive</label>
                        </div>
                
                    </div>
                </div>
            </div>
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('shippingcost/create')}}"><i class="far fa-times-circle"></i> Reset</a>
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
    var shipping_area=<?=json_encode($dataRow_BookingArea)?>;
    
    $(document).ready(function(){
        $('#delivery_city').change(function(){
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

            $("#delivery_area").html(area_html);
            $("#delivery_area").select2();

        });

        $(".select2").select2();
    });
    </script>

@endsection
        