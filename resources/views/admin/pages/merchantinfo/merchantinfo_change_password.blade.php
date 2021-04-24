
@extends("admin.layout.master")
@section("title","Edit Merchant Info")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1 align="center">&nbsp;</h1>
      </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-2">
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
      <div class="col-md-4 offset-4">
        <!-- general form elements -->
        <div class="card card-primary">
         
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('change/password')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 align="center"><i class="fa fa-key"></i> Change Your Password</h5>
                        <hr>
                    </div>
                </div>

                @if(Auth::user()->user_type_id!=1)                
                  <div class="row">
                      <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                          <label for="email">Your Current Password</label>
                          <input type="password" class="form-control" placeholder="Enter Your Current Password" id="email" name="current_password">
                        </div>
                      </div>
                  </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email">Enter New Password</label>
                        <input type="password" class="form-control" placeholder="Enter New Password" id="new_password" name="new_password">
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email">Re-Type New Password</label>
                        <input type="password" class="form-control" placeholder="Enter Re-Type Password" id="retype_password" name="retype_password">
                      </div>
                    </div>
                </div>
                
                
                
                        
                   
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Save Chnages
              </button>
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
        