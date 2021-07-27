@extends("public.layout.master")
@section("title","Bulk Order Tracking")
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

                <div class="body_section">
                    <div class="logo_section text-center">
                        <img src="{{asset('Gray/borakexpress_float_logo_1597820471.png')}}" class="logo_section_img">
                    </div>
                    <form method="POST" action="{{url('/public/tracking')}}">
                    <div class="search_section">
                        <div class="field" id="searchform">

                            <input @if ($data!=1 && $data !=0) value="{{$data[0]->order_id}}" @endif type="text" name="tracking_id" id="tracking_id" placeholder="Enter Borak Tracking No." required />
                            <button type="submit" id="search" >Find</button>

                        </div>
                    </div>
                    </form>
                    @if ($data!==1 && $data !==0)
                    <div class="tracking_status_section">
                        <ul id="progressbar" class="text-center">
                            @foreach($data as $parcel_status)
                            <li class="step0">
                                <div style="display: flex; justify-content: start; align-items: center; margin-right: 10px">
                                    <img src="{{asset('Gray/Shipped.svg')}}" width="30" height="30">
                                </div>
                                <div>
                                    <h5 class="step_heading">{{$parcel_status->parcel_status}}</h5>
                                    <p class="step_note">Order @if($parcel_status->parcel_status=='Pending') created @else {{strtolower($parcel_status->parcel_status)}} @endif by {{$parcel_status->username}}</p>
                                    <p class="step_date_time">{{date("F j, Y, g:i a", strtotime($parcel_status->created_at))}}</p>
                                </div>
                            </li>
                                @endforeach
                        </ul>
                    </div>
                    @endif
                     @if ($data ==0)
                        <div class="tracking_status_section">
                            <h2 style="text-align: center">Sorry! No tracking found. Please check your tracking ID.</h2>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <style>
        body{
            overflow-x: hidden;
        }
        .body_section{
            width: 100%;
            max-width: 550px;
            margin: 10px auto;
        }
        .progressbar_bg{
            background:#fff;
            width: 100%;
            padding: 20px 30px;
        }
        #progressbar {
            overflow: hidden;
            color: #000000;
            padding-left: 0px;
            /* background: #fff;
            padding: 20px 30px;
            width: 100%; */
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            height: auto;
            position: relative;
            font-weight: 400;
        }
        #progressbar li:last-child hr{
            border-bottom: none;
            display: none;
        }
        #progressbar li hr{
            border-bottom: 1px solid #000;
        }
        #progressbar li:after {
            width: 1px;
            height: 78px;
            border-left: 2px dotted red;
            position: absolute;
            content: '';
            top: 50%;
            left: 14px;
            z-index: -1;
        }
        #progressbar li:last-child:after {
            width: 0 !important;
            border: 0 !important;

        }
        #progressbar li:first-child .step_heading{
            color:#28a745 !important;

        }
        .step0{
            display: flex;
            margin: 15px 0;
        }
        .step_note{
            margin-bottom:5px !important;
        }

        .step_heading, .step_note, .step_date_time{
            margin: 0;
            text-align: left;
        }
        .step_image{
            width: 30px !important;
            max-width: 30px !important;
            height: 30px !important;
            z-index: 2;
        }
        .tracking_status_section{
            width: 100%;
            box-shadow: 0 3px 10px 2px rgb(0 0 0 / 4%);
            padding: 10px;
            margin: 20px 0;
        }
        .logo_section{
            width: 100%;
        }
        .text-center{
            text-align: center !important;
        }
        .logo_section_img{
            width: 30%;
        }
        .search_section{
            width: 100%;
            box-shadow: 0 3px 10px 2px rgb(0 0 0 / 4%);
            padding: 10px;
        }
        .field {
            display:flex;
            position:realtive;
            margin:2em auto;
            width:100%;
        }

        .field>input[type=text],
        .field>button {
            display:block;
            font:1.2em Myriad Pro;
        }

        .field>input[type=text] {
            flex:1;
            padding:0.6em;
            border:0.1em solid black;
        }
        .field>input[type=text]:focus {
            outline: none;
            border:0.1em solid #9e2074;
        }

        .field>button {
            padding:0.6em 0.8em;
            background-color: #9e2074;
            color:white;
            border:none;
        }.field>button:focus {
            outline: none !important;
            border:none;
        }
        .field>button:hover {
            cursor:pointer;
            background: #bf1e89;
        }
        #search:hover #searchterm{
            border:0.1em solid #bf1e89;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    </script>




@endsection
@section("css")
    @include("admin.include.lib.datatable.css")
@endsection

@section("js")
    @include("admin.include.lib.datatable.js")
@endsection



