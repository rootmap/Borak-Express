
@extends("admin.layout.master")
@section("title","Edit Site Setting")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Site Setting</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Site Setting</li>
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
            <h3 class="card-title">Edit / Modify Site Setting</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('sitesetting/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->site_name)){
                            ?>
                            value="{{$dataRow->site_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Site Name" id="site_name" name="site_name">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Nav Logo</label>
                                    <!-- <label for="customFile">Choose Nav Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="logo" name="logo">
                                      <input type="hidden" value="{{$dataRow->logo}}" name="ex_logo" />
                                      <label class="custom-file-label" for="customFile">Choose Nav Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->logo))
                                    @if(!empty($dataRow->logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesetting/'.$dataRow->logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Float Logo</label>
                                    <!-- <label for="customFile">Choose Float Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="float_logo" name="float_logo">
                                      <input type="hidden" value="{{$dataRow->float_logo}}" name="ex_float_logo" />
                                      <label class="custom-file-label" for="customFile">Choose Float Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->float_logo))
                                    @if(!empty($dataRow->float_logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesetting/'.$dataRow->float_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Fotter Logo</label>
                                    <!-- <label for="customFile">Choose Fotter Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="fotter_logo" name="fotter_logo">
                                      <input type="hidden" value="{{$dataRow->fotter_logo}}" name="ex_fotter_logo" />
                                      <label class="custom-file-label" for="customFile">Choose Fotter Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->fotter_logo))
                                    @if(!empty($dataRow->fotter_logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesetting/'.$dataRow->fotter_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->location)){
                            ?>
                            value="{{$dataRow->location}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Location" id="location" name="location">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->phone)){
                            ?>
                            value="{{$dataRow->phone}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Phone" id="phone" name="phone">
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
                        <label for="opening_hour">Opening Hour</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->opening_hour)){
                            ?>
                            value="{{$dataRow->opening_hour}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Opening Hour" id="opening_hour" name="opening_hour">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="merchant_signup_email_notification">Merchant Signup Email Notification</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->merchant_signup_email_notification)){
                            ?>
                            value="{{$dataRow->merchant_signup_email_notification}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Merchant Signup Email" id="merchant_signup_email_notification" name="merchant_signup_email_notification">
                      </div>
                    </div>

            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
              <label>Choose Site Status</label>
        
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
              <a class="btn btn-danger" href="{{url('sitesetting/edit/'.$dataRow->id)}}">
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
@section("js")

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

@endsection
        