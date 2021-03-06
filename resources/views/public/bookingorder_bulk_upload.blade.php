@extends("public.layout.master")
@section("title","Bulk Upload")
@section("content")
    <section class="content-header">
        <div class="container-fluid">
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



                <div class="card p-5">
                    <h2 class="text-center">Important Information for Bulk order upload</h2>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">Sending type</div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>sending type name</th>
                                                    <th>sending type Id</th>
                                                </tr>
                                                @foreach($dataRow_SendingType as $row)
                                                    <tr>
                                                        <td>{{$row->name}}</td>
                                                        <td>{{$row->id}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">Recipient City</div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>recipient city name</th>
                                                    <th>recipient city name Id</th>
                                                </tr>
                                                @foreach($dataRow_City as $row)
                                                    <tr>
                                                        <td>{{$row->name}}</td>
                                                        <td>{{$row->id}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">Package Name</div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>package id name</th>
                                                    <th>package Id</th>
                                                </tr>
                                                @foreach($dataRow_BookingPackage as $row)
                                                    <tr>
                                                        <td>{{$row->name}}</td>
                                                        <td>{{$row->id}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card">
                                                <div class="card-header">Parcel Type</div>
                                                <div class="card-body">

                                                    <table class="table">
                                                        <tr>
                                                            <th>parcel type name</th>
                                                            <th>parcel type Id</th>
                                                        </tr>
                                                        @foreach($dataRow_ItemType as $row)
                                                            <tr>
                                                                <td>{{$row->name}}</td>
                                                                <td>{{$row->id}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">Delivery Type</div>
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>delivery type name</th>
                                                                    <th>delivery type Id</th>
                                                                </tr>
                                                                @foreach($dataRow_BookingDeliveryType as $row)
                                                                    <tr>
                                                                        <td>{{$row->name}}</td>
                                                                        <td>{{$row->id}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">Payment Method</div>
                                                        <div class="card-body">
                                                            <table class="table">
                                                                <tr>
                                                                    <th>payment method name</th>
                                                                    <th>payment method Id</th>
                                                                </tr>
                                                                @foreach($dataRow_PaymentMethod as $row)
                                                                    <tr>
                                                                        <td>{{$row->name}}</td>
                                                                        <td>{{$row->id}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">Cost Management</div>
                                        <div class="card-body">
                                            <table class="table">
                                                <tr>
                                                    <th>Package Name</th>
                                                    <th>Shipping Cost</th>
                                                </tr>
                                                @foreach($dataRow_BookingPackage as $row)
                                                    <tr>
                                                        <td>{{$row->name}}</td>
                                                        <td>{{$row->price}} tk</td>
                                                    </tr>
                                                @endforeach

                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">Recipient Area</div>
                                        <div class="card-body">
                                            <input id="areaInput" type="text" placeholder="Search area here..."
                                            style="width: 100%;margin-bottom: 20px;">
                                            <table class="table" id="areaTable">
                                                <tr>
                                                    <th>recipient city name</th>
                                                    <th>recipient city name Id</th>
                                                    <th>recipient area area name</th>
                                                    <th>recipient area Id</th>
                                                </tr>
                                                <tbody id="areaTable_body">
                                                @foreach($dataRow_BookingArea as $row)
                                                    <tr>
                                                        <td>{{$row->city_id_name}}</td>
                                                        <td>{{$row->city_id}}</td>
                                                        <td>{{$row->area_name}}</td>
                                                        <td>{{$row->id}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <style>
        .card-header {
            font-size: 15px;
            font-weight: bold;
            background: #0c5460;
            color: #ffffff;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#areaInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#areaTable #areaTable_body >tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>




@endsection
@section("css")
    @include("admin.include.lib.datatable.css")
@endsection

@section("js")
    @include("admin.include.lib.datatable.js")
@endsection


