
@extends("admin.layout.master")
@section("title","Edit Merchant Info")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Merchant Info</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('merchantinfo/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('merchantinfo/create')}}">Create New </a></li>
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
      <div class="col-md-8 offset-2">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit / Modify Merchant Info</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('merchantinfo/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('merchantinfo/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('merchantinfo/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('merchantinfo/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('merchantinfo/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->full_name)){
                            ?>
                            value="{{$dataRow->full_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Full Name" id="full_name" name="full_name">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->mobile)){
                            ?>
                            value="{{$dataRow->mobile}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Mobile" id="mobile" name="mobile">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->email)){
                            ?>
                            value="{{$dataRow->email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Email" id="email" name="email">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->password)){
                            ?>
                            value="{{$dataRow->password}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Password" id="password" name="password">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="business_name">Business Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->business_name)){
                            ?>
                            value="{{$dataRow->business_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Business Name" id="business_name" name="business_name">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="business_address">Business Address</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->business_address)){
                            ?>
                            value="{{$dataRow->business_address}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Business Address" id="business_address" name="business_address">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="pickup_address">Pickup Address</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->pickup_address)){
                            ?>
                            value="{{$dataRow->pickup_address}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Pickup Address" id="pickup_address" name="pickup_address">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Payment Method</label>
                                  <select class="form-control select2" style="width: 100%;"  id="payment_method" name="payment_method">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_PaymentType)>0)
                                            @foreach($dataRow_PaymentType as $PaymentType)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->payment_method==$PaymentType->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$PaymentType->id}}">{{$PaymentType->name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>



                            <div class="col-md-6 mfs" style="display: none;">
                              <div class="form-group">
                                <label>Choose Wallet Provider</label>
                                <select class="form-control select2" style="width: 100%;"  id="wallet_provider_id" name="wallet_provider_id">
                                      <option value="">Please Select</option>
                                      @if(isset($wp))    
                                          @if(count($wp)>0)
                                              @foreach($wp as $PaymentType)
                                                  <option 
                                                    @isset($wp_mfs)
                                                        @if($wp_mfs->wallet_provider_id==$PaymentType->id)
                                                            selected="selected" 
                                                        @endif
                                                    @endisset
                                                  value="{{$PaymentType->id}}">{{$PaymentType->name}}</option>
                                                  
                                              @endforeach
                                          @endif
                                      @endif 
                                      
                                </select>
                              </div>
                          </div>
      
                          <div class="col-sm-6 mfs" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Wallet / Mobile No.</label>
                              <input type="text" class="form-control" 
                              @isset($wp_mfs)
                                  value="{{$wp_mfs->mobile_number}}"
                              @endisset
                              placeholder="Enter Wallet / Mobile No." id="wallet_no" name="wallet_no">
                            </div>
                          </div>
      
                          <div class="col-sm-6 bank" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Bank Name</label>
                              <input type="text" 
                              @isset($wp_bank)
                                  value="{{$wp_bank->bank_name}}"
                              @endisset 
                              class="form-control" placeholder="Enter Bank Name" id="bank_name" name="bank_name">
                            </div>
                          </div>
      
                          <div class="col-sm-6 bank" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Branch</label>
                              <input type="text" 
                              @isset($wp_bank)
                                  value="{{$wp_bank->bank_branch}}"
                              @endisset 
                              class="form-control" placeholder="Enter Bank Branch" id="branch" name="branch">
                            </div>
                          </div>
      
                          <div class="col-sm-6 bank" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Account Type</label>
                              <input type="text" 
                              @isset($wp_bank)
                                  value="{{$wp_bank->account_type}}"
                              @endisset 
                              class="form-control" placeholder="Enter Account Type" id="ac_type" name="ac_type">
                            </div>
                          </div>
      
                          <div class="col-sm-6 bank" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Account Name</label>
                              <input type="text" 
                              @isset($wp_bank)
                                  value="{{$wp_bank->account_name}}"
                              @endisset 
                              class="form-control" placeholder="Enter Account Name" id="ac_name" name="ac_name">
                            </div>
                          </div>
      
                          <div class="col-sm-6 bank" style="display: none;">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="pickup_address">Account Number</label>
                              <input type="text" 
                              @isset($wp_bank)
                                  value="{{$wp_bank->account_number}}"
                              @endisset 
                              class="form-control" placeholder="Enter Account Number" id="ac_no" name="ac_no">
                            </div>
                          </div>

            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Merchant Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Pending"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_0" name="module_status" value="Pending">
                          <label class="form-check-label">Pending</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Active"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_1" name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Block"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_2" name="module_status" value="Block">
                          <label class="form-check-label">Block</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Deleted"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_3" name="module_status" value="Deleted">
                          <label class="form-check-label">Deleted</label>
                        </div>
                
                    </div>
                </div>
            </div>
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('merchantinfo/edit/'.$dataRow->id)}}">
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
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
        $("#payment_method").change(function(){
            $(".mfs").hide();
            $(".bank").hide();
            var pm=$(this).val();
            if(pm==1)
            {
                $(".mfs").show();
            }
            else if(pm==2)
            {
                $(".bank").show();
            }
        });

        $("#payment_method").trigger('change');
    });
    </script>

@endsection
        