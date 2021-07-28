<?php

namespace App\Http\Controllers;

use App\AdminLog;
use App\BookingOrder;
use Auth;
use Illuminate\Http\Request;

class FrontServiceController extends Controller
{

    private $moduleName = "";
    private $sdc;
    public function __construct()
    {
        $this->sdc = new CoreCustomController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){



        if(Auth::user()->user_type_id==1)
        {
            $tab=BookingOrder::leftJoin('users','booking_orders.created_by','=','users.id')
                            ->leftJoin('merchant_infos','users.email','=','merchant_infos.email')
                            ->select('booking_orders.*',
                            'merchant_infos.full_name',
                            'merchant_infos.mobile',
                            'merchant_infos.email',
                            'merchant_infos.business_name',
                            'merchant_infos.business_address',
                            'merchant_infos.pickup_address'
                            )
                            ->orderBy('booking_orders.id','DESC')
                            ->whereDate('booking_orders.created_at', '=', date('Y-m-d'))
                            ->get();
                            
            $total_booking = BookingOrder::select('id')->count();
            $total_booking_Accepted = BookingOrder::select('id')->where('parcel_status','Accepted')->count();
            $total_booking_Pickup = BookingOrder::select('id')->where('parcel_status','Picked Up')->count();
            $total_booking_Delivered = BookingOrder::select('id')->where('parcel_status','Delivered')->count();
            $total_booking_Pending = BookingOrder::select('booking_orders.id')->where('booking_orders.parcel_status','Pending')->count();

          //  dd($total_booking_Pending); die;
            $total_booking_Cancel = BookingOrder::select('id')->where('parcel_status','Canceled')->count();
        }
        else
        {
            $tab=BookingOrder::leftJoin('users','booking_orders.created_by','=','users.id')
                            ->leftJoin('merchant_infos','users.email','=','merchant_infos.email')
                            ->select('booking_orders.*',
                            'merchant_infos.full_name',
                            'merchant_infos.mobile',
                            'merchant_infos.email',
                            'merchant_infos.business_name',
                            'merchant_infos.business_address',
                            'merchant_infos.pickup_address'
                            )
                            ->where('booking_orders.created_by',$this->sdc->UserID())
                            ->whereDate('booking_orders.created_at', '=', date('Y-m-d'))
                            ->orderBy('booking_orders.id','DESC')
                            ->get();

            $total_booking = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->count();
            $total_booking_Accepted = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->where('parcel_status','Accepted')->count();
            $total_booking_Pickup = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->where('parcel_status','Picked Up')->count();
            $total_booking_Delivered = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->where('parcel_status','Delivered')->count();
            $total_booking_Pending = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->where('parcel_status','Pending')->count();
            $total_booking_Cancel = BookingOrder::select('id')->where('created_by',$this->sdc->UserID())->where('parcel_status','Canceled')->count();
        }

         $data=[
             'dataRow'=>$tab,
             'total_booking'=>$total_booking,
             'total_booking_accepted'=>$total_booking_Accepted,
             'total_booking_Pickup'=>$total_booking_Pickup,
             'total_booking_Delivered'=>$total_booking_Delivered,
             'total_booking_Pending'=>$total_booking_Pending,
             'total_booking_Cancel'=>$total_booking_Cancel,
            ];

        return view('admin.pages.dashboard.index',$data);
    }

    private function SystemAdminLog($module_name = "", $action = "", $details = "")
    {
        $tab = new AdminLog();
        $tab->module_name = $module_name;
        $tab->action = $action;
        $tab->details = $details;
        $tab->admin_id = $this->sdc->admin_id();
        $tab->admin_name = $this->sdc->UserName();
        $tab->save();
    }

    public function booking($arrival='',$departure='',$adult='',$children=''){

        $country=Country::select('id','name','code')->orderBy('id','ASC')->get();
        // $region=Region::select('name','code','country_id')->orderBy('id','ASC')->get();
        // $city=City::select('name')->orderBy('id','ASC')->get();
        $slider=Slider::orderBy('id','DESC')->first();
        
        // $bookingCount=BookingRequest::whereDate('created_at',$arrival)->count();

        $data=[
            'slider'=>$slider,
            'arrival'=>$arrival,
            'departure'=>$departure,
            'adult'=>$adult,
            'children'=>$children,
            'country'=>$country

        ];

        //dd($data);

        return view('front-end.pages.booking',$data);
    }

    public function getRegion(Request $request){

        $country=Country::where('code',$request->country_id)->first();
        $region=Region::where('country_id',$country->id)->get();
        return response()->json($region);
    }

    public function bookingRoom($room=0, $arrival='',$departure='',$adult='',$children=''){

        $slider=Slider::orderBy('id','DESC')->first();
        $roomData = Room::find($room);
        // $bookingCount=BookingRequest::whereDate('created_at',$arrival)->count();
        return view('front-end.pages.booking-room',['roomData'=>$roomData,'room'=>$room,'slider'=>$slider,'arrival'=>$arrival,'departure'=>$departure,'adult'=>$adult,'children'=>$children]);
    }

    private function bookingTemplate($request, $room){


        $siteMessage='  <h2>
                            <strong><span style="color: #ff9900;">Room Reservation Detail</span></strong>
                        </h2>

                        <table style="border: 2px solid #000000; width: 436px;">

                        <tbody>

                        <tr style="height: 32px;">

                        <td style="width: 184px; height: 32px;">Reservation Created</td>

                        <td style="width: 244px; height: 32px;">&nbsp;'.date('dS M Y, h:i A').'</td>

                        </tr>

                        <tr style="height: 46px;">

                        <td style="width: 428px; height: 46px;" colspan="2">

                        <h3 style="display: block; width: 80%; border-bottom: 3px #000 solid;"><strong>Reservation Detail</strong></h3>

                        </td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Room Name</td>

                        <td style="width: 244px; height: 18px;">'.$room->room_name.' ('.$room->room_size.')</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Room Quantity</td>

                        <td style="width: 244px; height: 18px;">'.$room->room_quantity.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Booking Status</td>

                        <td style="width: 244px; height: 18px;">Pending</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Name</td>

                        <td style="width: 244px; height: 18px;">'.$request->customer_name.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Email&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->customer_email.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Phone&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->customer_phone.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Address&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->customer_address.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Reservation Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->reservation_date.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Arrival Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->arrival_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Departure Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->departure_date.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Adults</td>

                        <td style="width: 244px; height: 18px;">'.$request->adults.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Children</td>

                        <td style="width: 244px; height: 18px;">'.$request->children.'</td>

                        </tr>
                        </tbody>

                        </table>

                        <p>Kind Regards, '.$this->sdc->SiteName.'&nbsp;</p>

                        <p>&nbsp;</p>';

        return $siteMessage;
    }

    public function bookingConfirm(Request $request){

        if(empty($request->room)){
            return response()->json(['status'=>1,'msg'=>'Invalid Room ID, Please Select a valid room.']);
        }
        $tab_0_Room=Room::where('id',$request->room)->first();
        $room_0_Room=$tab_0_Room->room_name;
        $tab=new BookingRequest();

        if(empty($request->room_quantity)){
            return response()->json(['status'=>1,'msg'=>'Please select a room quantity.']);
        }
        elseif(empty($request->customer_name)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Name.']);
        }
        elseif(empty($request->customer_phone)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Phone.']);
        }
        elseif(empty($request->customer_email)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Email.']);
        }
        elseif(empty($request->customer_address)){
            return response()->json(['status'=>1,'msg'=>'Please Type Customer Address.']);
        }
        elseif(empty($request->arrival_date)){
            return response()->json(['status'=>1,'msg'=>'Please Type Arrival Date.']);
        }
        elseif(empty($request->departure_date)){
            return response()->json(['status'=>1,'msg'=>'Please Type Departure Date.']);
        }
        elseif(empty($request->adults)){
            return response()->json(['status'=>1,'msg'=>'Minimum One Adults Required.']);
        }
        
        $tab->room_room_name=$room_0_Room;
        $tab->room=$request->room;
        $tab->room_quantity=$request->room_quantity;
        $tab->customer_name=$request->customer_name;
        $tab->customer_phone=$request->customer_phone;
        $tab->customer_email=$request->customer_email;
        $tab->customer_address=$request->customer_address;
        $tab->arrival_date=$request->arrival_date;
        $tab->departure_date=$request->departure_date;
        $tab->adults=$request->adults;
        $tab->children=$request->children;
        $tab->booking_from="Online Booking";
        $tab->booking_status="Pending";
        $tab->save();

        $booking_Template=$this->bookingTemplate($request, $tab_0_Room);
        //echo $booking_Template; die();

        $BookingConfiguration=BookingConfiguration::orderBy('id','DESC')->first();

        $this->sdc->initMail($request->customer_email,
        'Online Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);


        $this->sdc->initMail($BookingConfiguration->booking_admin_email,
        'Online Room Reservation - '.$this->sdc->SiteName,
        $booking_Template);

            //$BookingConfiguration->booking_admin_email,

        return response()->json(['status'=>0,'msg'=>$BookingConfiguration->booking_success_message]);


    }

    public function checkBooking(Request $request){

        $from = date('Y-m-d',strtotime($request->arrival_date));
        $to = date('Y-m-d',strtotime($request->departure_date));

        $total=BookingRequest::whereBetween(\DB::Raw('DATE(arrival_date)'), [$from, $to])->count();
        return response()->json($total);
    }

    public function pages($pages=''){
        $FotterMenu=FotterMenu::where('menu_link',$pages)->first();
        $pageID=$FotterMenu->id;
        //dd($FotterMenu);
        $FotterPageContent=FotterPageContent::where('page_name',$pageID)->orderBy('id','ASC')->get();
        //dd($FotterPageContent);
        return view('front-end.pages.pages',['page'=>$FotterPageContent]);
    }

    public function index(){
        $SiteSetting=SiteSetting::orderBy('id','DESC')->first();
        $slider=Slider::orderBy('id','DESC')->first();
        $dreamContent=DreamContent::orderBy('id','DESC')->first();
        $videosContent=VideosContent::orderBy('id','DESC')->first();
        $exploreShelterInfo=ExploreShelterInfo::orderBy('id','DESC')->first();
        $peopleAndStory=PeopleAndStory::orderBy('id','DESC')->first();
        $RoomInfo=RoomInfo::orderBy('id','DESC')->first();
        $shelterPhoto=ShelterPhoto::where('module_status','Active')->orderBy('id','DESC')->get();
        $PeopleFeedback=PeopleFeedback::where('module_status','Active')->orderBy('id','DESC')->get();
        $RoomDetail=RoomDetail::where('module_status','Active')->orderBy('id','DESC')->get();
        $data=[
            'site'=>$SiteSetting,
            'dream'=>$dreamContent,
            'slider'=>$slider,
            'video'=>$videosContent,
            'shelter'=>$exploreShelterInfo,
            'shelterPhoto'=>$shelterPhoto,
            'peopleAndStory'=>$peopleAndStory,
            'peopleFeedback'=>$PeopleFeedback,
            'roomInfo'=>$RoomInfo,
            'roomDetail'=>$RoomDetail,
        ];
        return view('front-end.pages.index',$data);
    }
    
}
