
@extends("admin.layout.master")
@section("title","Merchant API Token")
@section("content")
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Merchant Token</h1>
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



            @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif

    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
</div>
@endif
              <!-- /.card -->
              <div class="card">
                
                <!-- /.card-header -->
                <div class="card-body text-center">

                  <div id="token_button_container mb-5">
                    <button id="showTokenModalBtn" class="btn btn-success">Get API Token</button><br>
                    <a href="{{url('merchantapi/download')}}" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Download Brochure </a><br>
                    <a href="{{url('merchantapi/pdf/123')}}" target="_blank" class="btn btn-large pull-right"><i class="icon-download-alt"> </i> PDF</a>
                  </div>
                  <form action="{{url('/merchantapi/importexcel')}}" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group">
                  <input type="file" name="file" >
                  <div>
                  <div>
                  <button type="submit" class="btn btn-success">Submit</button>
                  </div>

                  </form>
                  
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->


              <div class="card">

              <table>
              <tr>
              <td>
              <?php echo($dataRow_SendingType) ?>
              </td>
              </tr>
              </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          
  <!-- Modal HTML -->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p class="modal_body_text">Your token:- <span id="token"></span></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary copy_btn" onclick="copyToClipboard('#token')"><i class="far fa-copy"></i> Copy Token</button>
                </div>
            </div>
        </div>
    </div>
        </section>
        <style>
        .modal_body_text{
          width: 100%;
          color: #222;
          font-size:20px;
        }
        .modal_body_text span{
          width: 100%;
          color: #6ab393;
          font-size:25px;
          font-weight: 600;
        }

        </style>

       
<script>
    $(document).ready(function(){
        $("#showTokenModalBtn").click(function(){
            //$("#myModal").modal('show');
            gettoken();
        });
        $('button.copy_btn').click(function() {
      var self = $(this);
      if (!self.data('add')) {
        self.data('add', true);
        self.text('Copied');
        self.css('background', '#28a745');
        setTimeout(function() {
            self.html('<i class="far fa-copy"></i> Copy Token').data('add', false);
            self.css('background', '#007bff');
        }, 2000);
    }
});
    });
    function gettoken() {
      $.ajax({
    type: 'GET', //THIS NEEDS TO BE GET
    url: '/merchantapi/gettokenajax',
    //datatype: 'json',
    success: function (data) {
      $("#myModal").modal('show');
        //console.log(data);
       // $("#data").append(data);
       //var report = JSON.parse(data);
       $('#token').text(data[0].api_token);
    },
    error: function() { 
         console.log(data);
    }
});
      
    }
    function copyToClipboard(element) {
  var $temp = $("<input>");
  $("#token").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>

@endsection
@section("css")
    @include("admin.include.lib.datatable.css")
@endsection

@section("js")
    @include("admin.include.lib.datatable.js")
@endsection

        