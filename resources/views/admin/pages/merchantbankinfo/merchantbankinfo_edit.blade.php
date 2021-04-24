
@extends("admin.layout.master")
@section("title","Edit Merchant Bank Info")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Merchant Bank Info</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('merchantbankinfo/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('merchantbankinfo/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Merchant Bank Info</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('merchantbankinfo/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('merchantbankinfo/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('merchantbankinfo/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('merchantbankinfo/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('merchantbankinfo/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label>Choose Merchant</label>
                                  <select class="form-control select2" style="width: 100%;"  id="merchant_id" name="merchant_id">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_MerchantInfo)>0)
                                            @foreach($dataRow_MerchantInfo as $MerchantInfo)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->id==$MerchantInfo->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$MerchantInfo->id}}">{{$MerchantInfo->full_name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>
          
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="bank_name">Bank Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->bank_name)){
                            ?>
                            value="{{$dataRow->bank_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Bank Name" id="bank_name" name="bank_name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="bank_branch">Bank Branch</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->bank_branch)){
                            ?>
                            value="{{$dataRow->bank_branch}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Bank Branch" id="bank_branch" name="bank_branch">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="account_type">Account Type</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->account_type)){
                            ?>
                            value="{{$dataRow->account_type}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Account Type" id="account_type" name="account_type">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="account_name">Account Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->account_name)){
                            ?>
                            value="{{$dataRow->account_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Account Name" id="account_name" name="account_name">
                      </div>
                    </div>
   
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="account_number">Account Number</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->account_number)){
                            ?>
                            value="{{$dataRow->account_number}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Account Number" id="account_number" name="account_number">
                      </div>
                    </div>
                </div>
                
        <div class="row">
            <div class="col-sm-12">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Bank Status</label>
        
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Active"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_0" name="module_status" value="Active">
                          <label class="form-check-label">Active</label>
                        </div>
                
                        <div class="form-check">
                            <input class="form-check-input" type="radio"  
                                <?php 
                                if($dataRow->module_status=="Inactive"){
                                    ?>
                                    checked="checked" 
                                    <?php 
                                }
                                ?>
                          id="module_status_1" name="module_status" value="Inactive">
                          <label class="form-check-label">Inactive</label>
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
              <a class="btn btn-danger" href="{{url('merchantbankinfo/edit/'.$dataRow->id)}}">
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
    });
    </script>

@endsection
        