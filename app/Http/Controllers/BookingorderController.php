<?php

namespace App\Http\Controllers;
use DB;
use App\BookingOrder;
use App\AdminLog;
use Illuminate\Http\Request;
use App\ItemType;              
use App\City;      
use App\BookingArea;       
use App\BookingDeliveryType;      
use App\SendingType;      
use App\BookingPackage;
use App\PaymentMethod;
use App\ShippingCost;
use App\MerchantInfo;
use App\OrderStatusHistory;  
use Auth;
use Session;
use PDF;
use Mpdf\Mpdf;


class BookingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Booking Order";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function search(Request $request){
        $search=$request->search;
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(booking_orders.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $status='';
        if(isset($request->status))
        {
            $status=$request->status;
        }

        $merchant_id='';
        if(isset($request->merchant_id))
        {
            $merchant_id=$request->merchant_id;
        }

        $city_id='';
        if(isset($request->city_id))
        {
            $city_id=$request->city_id;
        }
        

        $area_id='';
        if(isset($request->area_id))
        {
            $area_id=$request->area_id;
        }
        
       

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
                ->when($merchant_id, function ($query) use ($merchant_id) {
                        return $query->where('booking_orders.created_by',$merchant_id);
                })
                ->when($city_id, function ($query) use ($city_id) {
                        return $query->where('booking_orders.recipient_city',$city_id);
                })
                ->when($search, function ($query) use ($search) {
                              
                    $query->whereRaw("(booking_orders.id LIKE '%".$search."%' OR booking_orders.recipient_number LIKE '%".$search."%' OR 
                    booking_orders.recipient_name LIKE '%".$search."%' OR 
                    booking_orders.package_id LIKE '%".$search."%')");

                    return $query;
                })
                ->when($dateString, function ($query) use ($dateString) {
                        return $query->whereRaw($dateString);
                })
                ->when($status, function ($query) use ($status) {
                        return $query->where('booking_orders.parcel_status',$status);
                })
                
                ->take(50)
                ->get();

                // dd($tab);

                // dd($merchant_id);
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
                            ->when($search, function ($query) use ($search) {
                                            
                                $query->whereRaw("(booking_orders.id LIKE '%".$search."%' OR booking_orders.recipient_number LIKE '%".$search."%' OR 
                                booking_orders.recipient_name LIKE '%".$search."%' OR 
                                booking_orders.package_id LIKE '%".$search."%')");

                                return $query;
                            })
                            ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                            })
                            ->when($status, function ($query) use ($status) {
                                    return $query->where('booking_orders.parcel_status',$status);
                            })
                            ->orderBy('booking_orders.id','DESC')
                            ->take(50)
                            ->get();
        }

        $tab_MerchantInfo=MerchantInfo::select('merchant_infos.id','merchant_infos.full_name','merchant_infos.email','merchant_infos.mobile','merchant_infos.business_name','users.id as user_id')
                                        ->leftJoin('users','merchant_infos.email','=','users.email')
                                        ->get();  
        $tab_City=City::all();  
        $tab_BookingArea=BookingArea::all(); 

        //dd($tab);
        
        return view('admin.pages.bookingorder.bookingorder_search',[
            'dataRow'=>$tab,
            'merchant'=>$tab_MerchantInfo,
            'city'=>$tab_City,
            'city_id'=>$city_id,
            'deliver_area'=>$tab_BookingArea,
            'area_id'=>$area_id,
            'merchant_id'=>$merchant_id,
            'search'=>$request->search,
            'start_date'=>$start_date,
            'end_date'=>$request->end_time,
            'status'=>$status
            ]);
    }

    private function filterExport($request){
        $search=$request->search;
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(booking_orders.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $status='';
        if(isset($request->status))
        {
            $status=$request->status;
        }

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
                ->when($search, function ($query) use ($search) {
                              
                    $query->whereRaw("(booking_orders.id LIKE '%".$search."%' OR booking_orders.recipient_number LIKE '%".$search."%' OR 
                    booking_orders.recipient_name LIKE '%".$search."%' OR 
                    booking_orders.package_id LIKE '%".$search."%')");

                    return $query;
                })
                ->when($dateString, function ($query) use ($dateString) {
                        return $query->whereRaw($dateString);
                })
                ->when($status, function ($query) use ($status) {
                        return $query->where('booking_orders.parcel_status',$status);
                })
                ->get();
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
                            ->when($search, function ($query) use ($search) {
                                            
                                $query->whereRaw("(booking_orders.id LIKE '%".$search."%' OR booking_orders.recipient_number LIKE '%".$search."%' OR 
                                booking_orders.recipient_name LIKE '%".$search."%' OR 
                                booking_orders.package_id LIKE '%".$search."%')");

                                return $query;
                            })
                            ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                            })
                            ->when($status, function ($query) use ($status) {
                                    return $query->where('booking_orders.parcel_status',$status);
                            })
                            ->orderBy('booking_orders.id','DESC')
                            ->get();
        }

        return $tab;
    }

    public function exportFilterExcel(Request $request){
        $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
            'ID',
            'Merchant Name',
            'Merchant Phone',
            'Merchant Business Name',
            'Sending Type',
            'Recipient Number',
            'Recipient 2nd Number',
            'Recipient Name',
            'Special Notes',
            'Address',
            'Recipient City',
            'Recipient Area',
            'Landmarks',
            'Pickup Address',
            'Product ID',
            'Parcel Type',
            'Delivery Type',
            'Package Type',
            'Product Price',
            'Payment Method',
            'Deliver Date',
            'No of Items',
            'Parcel Status',
            'Payment Status',
            'Created Date','');
        array_push($data, $array_column);
        $inv=$this->filterExport($request);
        foreach($inv as $voi):
            $inv_arry=array(
                $voi->id,
                $voi->full_name,
                $voi->mobile,
                $voi->business_name,
                $voi->sending_type_name,
                $voi->recipient_number,
                $voi->recipient_number_two,
                $voi->recipient_name,
                $voi->special_note,
                $voi->address,
                $voi->recipient_city_name,
                $voi->recipient_area_area_name,
                $voi->landmarks,
                $voi->pickup_address,
                $voi->product_id,
                $voi->parcel_type_name,
                $voi->delivery_type_name,
                $voi->package_id_name,
                $voi->product_price,
                $voi->payment_method_name,
                $voi->deliver_date,
                $voi->no_of_items,
                $voi->parcel_status,
                $voi->payment_status,
                formatDateTime($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Booking Order Report',
            'report_title'=>'Booking Order Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
    }

    public function exportFilterPDF(Request $request){
        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                <th class='text-center' style='font-size:12px;' >Merchant Name</th>
                <th class='text-center' style='font-size:12px;' >Merchant Phone</th>
                <th class='text-center' style='font-size:12px;' >Merchant Business</th>

                <th class='text-center' style='font-size:12px;' >Sending Type</th>
            
                <th class='text-center' style='font-size:12px;' >Recipient Number</th>
                <th class='text-center' style='font-size:12px;' >Recipient 2nd Number</th>
            
                <th class='text-center' style='font-size:12px;' >Recipient Name</th>
                <th class='text-center' style='font-size:12px;' >Special Notes</th>
            
                <th class='text-center' style='font-size:12px;' >Address</th>
            
                <th class='text-center' style='font-size:12px;' >Recipient City</th>
            
                <th class='text-center' style='font-size:12px;' >Recipient Area</th>
            
                <th class='text-center' style='font-size:12px;' >Landmarks</th>
                <th class='text-center' style='font-size:12px;' >Pickup Address</th>
            
                <th class='text-center' style='font-size:12px;' >Product ID</th>
            
                <th class='text-center' style='font-size:12px;' >Parcel Type</th>
            
                <th class='text-center' style='font-size:12px;' >Delivery Type</th>
            
                <th class='text-center' style='font-size:12px;' >Package ID</th>
            
                <th class='text-center' style='font-size:12px;' >Product Price</th>
                <th class='text-center' style='font-size:12px;' >Payment Method</th>
            
                <th class='text-center' style='font-size:12px;' >Deliver Date</th>
            
                <th class='text-center' style='font-size:12px;' >No of Items</th>
            
                <th class='text-center' style='font-size:12px;' >Parcel Status</th>
            
                <th class='text-center' style='font-size:12px;' >Payment Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->filterExport($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->full_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->mobile."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->business_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sending_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number_two."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->special_note."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_city_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_area_area_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->landmarks."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->pickup_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->package_id_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_method_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->deliver_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->no_of_items."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_status."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDateTime($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Order Report',$html,"L");
    }

    public function index(){
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
                             ->get();

            //dd($tab);
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
            ->orderBy('booking_orders.id','DESC')
            ->get();
        }


        //dd($tab);
        
        return view('admin.pages.bookingorder.bookingorder_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $order_id=0;       
        // $order_id=Session::has('order_id')?Session::get('order_id'):'';

        // if(empty($order_id) && strlen($order_id)==0)
        // {
        //     Session::put('order_id','BE'.unique());
        //     $order_id=Session::get('order_id');
        // }
        
        $tab_ItemType=ItemType::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();
        $tab_ItemType=ItemType::all();
        $tab_SendingType=SendingType::all();
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();           
        $tab_PaymentMethod=PaymentMethod::all();           
        $tab_ShippingCost=ShippingCost::all();        
        $tab_MerchantInfo=MerchantInfo::select('merchant_infos.id','merchant_infos.full_name','merchant_infos.email','merchant_infos.mobile','merchant_infos.business_name','users.id as user_id')
                                        ->leftJoin('users','merchant_infos.email','=','users.email')
                                        ->get();         
        
       // dd($order_id);
        
        return view('admin.pages.bookingorder.bookingorder_create',['dataRow_ItemType'=>$tab_ItemType,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea,
        'order_id'=>$order_id,
        'dataRow_ItemType'=>$tab_ItemType,
        'dataRow_SendingType'=>$tab_SendingType,
        'dataRow_PaymentMethod'=>$tab_PaymentMethod,
        'dataRow_ShippingCost'=>$tab_ShippingCost,
        'dataRow_MerchantInfo'=>$tab_MerchantInfo,
        'dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function SystemAdminLog($module_name="",$action="",$details=""){
        $tab=new AdminLog();
        $tab->module_name=$module_name;
        $tab->action=$action;
        $tab->details=$details;
        $tab->admin_id=$this->sdc->admin_id();
        $tab->admin_name=$this->sdc->UserName();
        $tab->save();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
                
                'sending_type'=>'required',
                'recipient_number'=>'required',
                'recipient_name'=>'required',
                'address'=>'required',
                'recipient_city'=>'required',
                'recipient_area'=>'required',
                'parcel_type'=>'required',
                'delivery_type'=>'required',
                'package_id'=>'required',
                'payment_method'=>'required',
                'product_price'=>'required',
                'deliver_date'=>'required',
                'no_of_items'=>'required',
        ]);

        $order_created_by=$this->sdc->UserID();

        if (Auth::user()->user_type_id==1) {
            $this->validate($request,[
                'parcel_status'=>'required',
                'merchant_id'=>'required',
            ]);
            $parcel_status=$request->parcel_status;    
            $payment_status=$request->payment_status;    
            $order_created_by=$request->merchant_id;
        }
        else
        {
            $parcel_status="Pending";    
            $payment_status="";   
        }

        

        $this->SystemAdminLog("Booking Order","Save New","Create New");

        //$tab_SendingType=SendingType::all();
        $tab_0_ItemType=SendingType::where('id',$request->sending_type)->first();
        $sending_type_0_ItemType=$tab_0_ItemType->name;

        $tab_0_PaymentMethod=PaymentMethod::where('id',$request->payment_method)->first();
        $PaymentMethod_name=$tab_0_PaymentMethod->name;

        $tab_4_City=City::where('id',$request->recipient_city)->first();
        $recipient_city_4_City=$tab_4_City->name;
        $tab_5_BookingArea=BookingArea::where('id',$request->recipient_area)->first();
        $recipient_area_5_BookingArea=$tab_5_BookingArea->area_name;
        $tab_8_ItemType=ItemType::where('id',$request->parcel_type)->first();
        $parcel_type_8_ItemType=$tab_8_ItemType->name;
        $tab_9_BookingDeliveryType=BookingDeliveryType::where('id',$request->delivery_type)->first();
        $delivery_type_9_BookingDeliveryType=$tab_9_BookingDeliveryType->name;
        $tab_10_BookingPackage=BookingPackage::where('id',$request->package_id)->first();
        $package_id_10_BookingPackage=$tab_10_BookingPackage->name;
        
        $tab=new BookingOrder();
        $tab->sending_type_name=$sending_type_0_ItemType;
        $tab->sending_type=$request->sending_type;
        $tab->recipient_number=$request->recipient_number;
        $tab->recipient_number_two=$request->recipient_number_two;
        $tab->recipient_name=$request->recipient_name;
        $tab->address=$request->address;
        $tab->recipient_city_name=$recipient_city_4_City;
        $tab->recipient_city=$request->recipient_city;
        $tab->recipient_area_area_name=$recipient_area_5_BookingArea;
        $tab->recipient_area=$request->recipient_area;
        $tab->landmarks=$request->landmarks;
        $tab->product_id=$request->product_id;
        $tab->parcel_type_name=$parcel_type_8_ItemType;
        $tab->parcel_type=$request->parcel_type;
        $tab->delivery_type_name=$delivery_type_9_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_id_name=$package_id_10_BookingPackage;
        $tab->package_id=$request->package_id;
        $tab->product_price=$request->product_price;
        $tab->deliver_date=$request->deliver_date;
        $tab->no_of_items=$request->no_of_items;
        $tab->special_note=$request->special_note;
        $tab->parcel_status=$parcel_status;
        $tab->payment_method=$request->payment_method;
        $tab->payment_method_name=$PaymentMethod_name;
        $tab->shipping_cost=$request->shipping_cost;
        $tab->total_charge=$request->total_charge;
        $tab->payment_status=$payment_status;
        $tab->created_by=$order_created_by;
        $tab->save();
        $order_status = new OrderStatusHistory;
            
            $order_status->parcel_status = $parcel_status;;
            $order_status->order_id = $tab->id;
            $order_status->created_by = $order_created_by;
            $order_status->remarks = '';

            $order_status->save();

        Session::put('booking_id',$tab->id);

        return redirect('bookingorder')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'sending_type'=>'required',
                'recipient_number'=>'required',
                'recipient_name'=>'required',
                'address'=>'required',
                'recipient_city'=>'required',
                'recipient_area'=>'required',
                'landmarks'=>'required',
                'product_id'=>'required',
                'parcel_type'=>'required',
                'delivery_type'=>'required',
                'package_id'=>'required',
                'product_price'=>'required',
                'deliver_date'=>'required',
                'no_of_items'=>'required',
                'parcel_status'=>'required',
                'payment_status'=>'required',
        ]);

        $tab=new BookingOrder();
        
        $tab->sending_type_name=$sending_type_0_ItemType;
        $tab->sending_type=$request->sending_type;
        $tab->recipient_number=$request->recipient_number;
        $tab->recipient_name=$request->recipient_name;
        $tab->address=$request->address;
        $tab->recipient_city_name=$recipient_city_4_City;
        $tab->recipient_city=$request->recipient_city;
        $tab->recipient_area_area_name=$recipient_area_5_BookingArea;
        $tab->recipient_area=$request->recipient_area;
        $tab->landmarks=$request->landmarks;
        $tab->product_id=$request->product_id;
        $tab->parcel_type_name=$parcel_type_8_ItemType;
        $tab->parcel_type=$request->parcel_type;
        $tab->delivery_type_name=$delivery_type_9_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_id_name=$package_id_10_BookingPackage;
        $tab->package_id=$request->package_id;
        $tab->product_price=$request->product_price;
        $tab->deliver_date=$request->deliver_date;
        $tab->no_of_items=$request->no_of_items;
        $tab->parcel_status=$request->parcel_status;
        $tab->payment_status=$request->payment_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingOrder  $bookingorder
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('sending_type','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_number','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_name','LIKE','%'.$search.'%');
                            $query->orWhere('address','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_city','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_area','LIKE','%'.$search.'%');
                            $query->orWhere('landmarks','LIKE','%'.$search.'%');
                            $query->orWhere('product_id','LIKE','%'.$search.'%');
                            $query->orWhere('parcel_type','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_type','LIKE','%'.$search.'%');
                            $query->orWhere('package_id','LIKE','%'.$search.'%');
                            $query->orWhere('product_price','LIKE','%'.$search.'%');
                            $query->orWhere('deliver_date','LIKE','%'.$search.'%');
                            $query->orWhere('no_of_items','LIKE','%'.$search.'%');
                            $query->orWhere('parcel_status','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->count();
        return $tab;
    }


    private function methodToGetMembers($start, $length,$search=''){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('sending_type','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_number','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_name','LIKE','%'.$search.'%');
                            $query->orWhere('address','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_city','LIKE','%'.$search.'%');
                            $query->orWhere('recipient_area','LIKE','%'.$search.'%');
                            $query->orWhere('landmarks','LIKE','%'.$search.'%');
                            $query->orWhere('product_id','LIKE','%'.$search.'%');
                            $query->orWhere('parcel_type','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_type','LIKE','%'.$search.'%');
                            $query->orWhere('package_id','LIKE','%'.$search.'%');
                            $query->orWhere('product_price','LIKE','%'.$search.'%');
                            $query->orWhere('deliver_date','LIKE','%'.$search.'%');
                            $query->orWhere('no_of_items','LIKE','%'.$search.'%');
                            $query->orWhere('parcel_status','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }

    public function datatable(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    
    public function BookingOrderQuery($request)
    {
        //$BookingOrder_data=BookingOrder::orderBy('id','DESC')->get();

        if(Auth::user()->user_type_id==1)
        {
            $BookingOrder_data=BookingOrder::leftJoin('users','booking_orders.created_by','=','users.id')
                            ->leftJoin('merchant_infos','users.email','=','merchant_infos.email')
                            ->select('booking_orders.*',
                            'merchant_infos.full_name',
                            'merchant_infos.mobile',
                            'merchant_infos.email',
                            'merchant_infos.business_name',
                            'merchant_infos.business_address',
                            'merchant_infos.pickup_address'
                            )
                            ->orderBy('booking_orders.id','DESC')->get();
        }
        else
        {
            $BookingOrder_data=BookingOrder::leftJoin('users','booking_orders.created_by','=','users.id')
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
                                            ->orderBy('booking_orders.id','DESC')
                                            ->get();
        }

        return $BookingOrder_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                            'ID',
                            'Merchant Name',
                            'Merchant Phone',
                            'Merchant Business Name',
                            'Sending Type',
                            'Recipient Number',
                            'Recipient 2nd Number',
                            'Recipient Name',
                            'Special Notes',
                            'Address',
                            'Recipient City',
                            'Recipient Area',
                            'Landmarks',
                            'Pickup Address',
                            'Product ID',
                            'Parcel Type',
                            'Delivery Type',
                            'Package Type',
                            'Product Price',
                            'Payment Method',
                            'Deliver Date',
                            'No of Items',
                            'Parcel Status',
                            'Payment Status',
                            'Created Date','');
        array_push($data, $array_column);
        $inv=$this->BookingOrderQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                            $voi->id,
                            $voi->full_name,
                            $voi->mobile,
                            $voi->business_name,
                            $voi->sending_type_name,
                            $voi->recipient_number,
                            $voi->recipient_number_two,
                            $voi->recipient_name,
                            $voi->special_note,
                            $voi->address,
                            $voi->recipient_city_name,
                            $voi->recipient_area_area_name,
                            $voi->landmarks,
                            $voi->pickup_address,
                            $voi->product_id,
                            $voi->parcel_type_name,
                            $voi->delivery_type_name,
                            $voi->package_id_name,
                            $voi->product_price,
                            $voi->payment_method_name,
                            $voi->deliver_date,
                            $voi->no_of_items,
                            $voi->parcel_status,
                            $voi->payment_status,
                            formatDateTime($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Booking Order Report',
            'report_title'=>'Booking Order Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function ExportPDF(Request $request)
    {

        $html="<table class='table table-bordered' style='width:100%; font-family: 'SolaimanLipi', sans-serif;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Merchant Name</th>
                            <th class='text-center' style='font-size:12px;' >Merchant Phone</th>
                            <th class='text-center' style='font-size:12px;' >Merchant Business</th>

                            <th class='text-center' style='font-size:12px;' >Sending Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Number</th>
                            <th class='text-center' style='font-size:12px;' >Recipient 2nd Number</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Name</th>
                            <th class='text-center' style='font-size:12px;' >Special Notes</th>
                        
                            <th class='text-center' style='font-size:12px;' >Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient City</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Area</th>
                        
                            <th class='text-center' style='font-size:12px;' >Landmarks</th>
                            <th class='text-center' style='font-size:12px;' >Pickup Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Parcel Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Delivery Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Package ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product Price</th>
                            <th class='text-center' style='font-size:12px;' >Payment Method</th>
                        
                            <th class='text-center' style='font-size:12px;' >Deliver Date</th>
                        
                            <th class='text-center' style='font-size:12px;' >No of Items</th>
                        
                            <th class='text-center' style='font-size:12px;' >Parcel Status</th>
                        
                            <th class='text-center' style='font-size:12px;' >Payment Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->BookingOrderQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->full_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->mobile."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->business_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sending_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number_two."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->special_note."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_city_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_area_area_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->landmarks."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->pickup_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->package_id_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_method_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->deliver_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->no_of_items."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_status."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDateTime($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Order Report',$html,"L");


    }
    public function show(BookingOrder $bookingorder)
    {
        
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
                            ->orderBy('booking_orders.id','DESC')->get();
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
                            ->orderBy('booking_orders.id','DESC')
                            ->get();
        }
        return view('admin.pages.bookingorder.bookingorder_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingOrder  $bookingorder
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {

        

        $tab=BookingOrder::find($id); 

        if($tab->parcel_status!="Pending")
        {
            if(Auth::user()->user_type_id!=1)
            {
                return redirect(url('dashboard'))->with('error','Invalid Request.');
            }
        }

        

        $tab_ItemType=ItemType::all();
        $tab_SendingType=SendingType::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();
        $tab_ItemType=ItemType::all();
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();     
        $tab_PaymentMethod=PaymentMethod::all();   
        $tab_ShippingCost=ShippingCost::all();
        $tab_MerchantInfo=MerchantInfo::select('merchant_infos.id','merchant_infos.full_name','merchant_infos.email','merchant_infos.mobile','merchant_infos.business_name','users.id as user_id')
                                        ->leftJoin('users','merchant_infos.email','=','users.email')
                                        ->get();  
        return view('admin.pages.bookingorder.bookingorder_edit',[
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_City'=>$tab_City,
            'dataRow_BookingArea'=>$tab_BookingArea,
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_SendingType'=>$tab_SendingType,
            'dataRow_ShippingCost'=>$tab_ShippingCost,
            'dataRow_PaymentMethod'=>$tab_PaymentMethod,
            'dataRow_MerchantInfo'=>$tab_MerchantInfo,
            'dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'dataRow'=>$tab,'edit'=>true]);  
    }

    public function tracking(Request $request)
    {

        $tracking_no=$request->tracking_no;

        $tracking_count=BookingOrder::where('id',$tracking_no)->count();

        if($tracking_count==0)
        {
            return response()->json(['status'=>0,'message'=>'Invalid order tracking no.']);
        }
        else
        {
            $tracking=BookingOrder::where('id',$tracking_no)->first();
            return response()->json(['status'=>1,'message'=>'Your order status is <b>'.$tracking->parcel_status.'</b>']);
        }

          
    }

    public function view(BookingOrder $bookingorder,$id=0)
    {
        $tab=BookingOrder::find($id); 
        $tab_ItemType=ItemType::all();
        $tab_SendingType=SendingType::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();
        $tab_ItemType=ItemType::all();
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();     
        $tab_ShippingCost=ShippingCost::all();
        return view('admin.pages.bookingorder.bookingorder_view',['dataRow_ItemType'=>$tab_ItemType,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea,
        'dataRow_ItemType'=>$tab_ItemType,
        'dataRow_ShippingCost'=>$tab_ShippingCost,
        'dataRow_SendingType'=>$tab_SendingType,
        'dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingOrder  $bookingorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingOrder $bookingorder,$id=0)
    {
        $this->validate($request,[
                    
                'sending_type'=>'required',
                'recipient_number'=>'required',
                'recipient_name'=>'required',
                'address'=>'required',
                'recipient_city'=>'required',
                'recipient_area'=>'required',
                'parcel_type'=>'required',
                'delivery_type'=>'required',
                'package_id'=>'required',
                'payment_method'=>'required',
                'product_price'=>'required',
                'deliver_date'=>'required',
                'no_of_items'=>'required',
        ]);

        $order_created_by=$this->sdc->UserID();
        if (Auth::user()->user_type_id==1) {
            $this->validate($request,[
                'parcel_status'=>'required',
                'merchant_id'=>'required',
            ]);
            $parcel_status=$request->parcel_status;    
            $payment_status=$request->payment_status;  
            $order_created_by=$request->merchant_id;  
        }
        else
        {
            $parcel_status="Pending";    
            $payment_status="";   
        }

        $this->SystemAdminLog("Booking Order","Update","Edit / Modify");

        //$tab_SendingType=SendingType::all();

        
        $tab_0_PaymentMethod=PaymentMethod::where('id',$request->payment_method)->first();
        $PaymentMethod_name=$tab_0_PaymentMethod->name;
        
        $tab_0_ItemType=SendingType::where('id',$request->sending_type)->first();
        $sending_type_0_ItemType=$tab_0_ItemType->name;
        $tab_4_City=City::where('id',$request->recipient_city)->first();
        $recipient_city_4_City=$tab_4_City->name;
        $tab_5_BookingArea=BookingArea::where('id',$request->recipient_area)->first();
        $recipient_area_5_BookingArea=$tab_5_BookingArea->area_name;
        $tab_8_ItemType=ItemType::where('id',$request->parcel_type)->first();
        $parcel_type_8_ItemType=$tab_8_ItemType->name;
        $tab_9_BookingDeliveryType=BookingDeliveryType::where('id',$request->delivery_type)->first();
        $delivery_type_9_BookingDeliveryType=$tab_9_BookingDeliveryType->name;
        $tab_10_BookingPackage=BookingPackage::where('id',$request->package_id)->first();
        $package_id_10_BookingPackage=$tab_10_BookingPackage->name;

        $tab=BookingOrder::find($id);
        $tab->sending_type_name=$sending_type_0_ItemType;
        $tab->sending_type=$request->sending_type;
        $tab->recipient_number=$request->recipient_number;
        $tab->recipient_number_two=$request->recipient_number_two;
        $tab->recipient_name=$request->recipient_name;
        $tab->address=$request->address;
        $tab->recipient_city_name=$recipient_city_4_City;
        $tab->recipient_city=$request->recipient_city;
        $tab->recipient_area_area_name=$recipient_area_5_BookingArea;
        $tab->recipient_area=$request->recipient_area;
        $tab->landmarks=$request->landmarks;
        $tab->product_id=$request->product_id;
        $tab->parcel_type_name=$parcel_type_8_ItemType;
        $tab->parcel_type=$request->parcel_type;
        $tab->delivery_type_name=$delivery_type_9_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_id_name=$package_id_10_BookingPackage;
        $tab->package_id=$request->package_id;
        $tab->product_price=$request->product_price;
        $tab->deliver_date=$request->deliver_date;
        $tab->no_of_items=$request->no_of_items;
        $tab->special_note=$request->special_note;
        $tab->payment_method=$request->payment_method;
        $tab->payment_method_name=$PaymentMethod_name;
        $tab->shipping_cost=$request->shipping_cost;
        $tab->total_charge=$request->total_charge;
        $tab->parcel_status=$parcel_status;
        $tab->payment_status=$payment_status;
        $tab->updated_by=$order_created_by;
        $tab->save();

        $order_status = new OrderStatusHistory;
        $check_parcel_insertion_status = DB::table('booking_order_status_history')->where('order_id','=',$id)
        ->where('parcel_status','=',$request->parcel_status)->count();
  //  print_r($check_parcel_insertion_status); die;
          if($check_parcel_insertion_status<1){
            
            $order_status->parcel_status = $request->parcel_status;
            $order_status->order_id = $id;
            $order_status->created_by = $order_created_by;
            //$order_status->remarks = $request->special_note;
            $order_status->remarks = '';

            $order_status->save();
          }

        return redirect('bookingorder')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingOrder  $bookingorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingOrder $bookingorder,$id=0)
    {
        $this->SystemAdminLog("Booking Order","Destroy","Delete");

        $tab=BookingOrder::find($id);
        $tab->delete();
        return redirect('bookingorder')->with('status','Deleted Successfully !');
    }

//    pdf start

    function generatePdf($id)
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($this->convert_customer_data_to_html($id));

        $mpdf->Output('order_'.$id.'.pdf', \Mpdf\Output\Destination::INLINE);
    }
    function convert_customer_data_to_html($id)
    {
        $data = BookingOrder::leftJoin('users','booking_orders.created_by','=','users.id')
            ->leftJoin('merchant_infos','users.email','=','merchant_infos.email')
            ->select('booking_orders.*',
                'merchant_infos.full_name',
                'merchant_infos.mobile',
                'merchant_infos.email',
                'merchant_infos.business_name',
                'merchant_infos.business_address',
                'merchant_infos.pickup_address'
            )
            ->where('booking_orders.id', '=', $id)
            ->orderBy('booking_orders.id','DESC')
            ->first();
        $delivered = '';
        if( $data->parcel_status == "Delivered")
        {
            $delivered .= '
             <input type="image" id="delivered" src="'.asset("Gray/checked.png").'" >
             ';
        } else {
            $delivered .='
        <input type="checkbox"  id="delivered" name="delivered" >';
        }
        $cancel = '';
        if( $data->parcel_status == "Cancel")
        {
            $cancel .= '
             <input type="image" id="cancel" src="'.asset("Gray/checked.png").'" >
            ';
        } else {
            $cancel .='
        <input type="checkbox"  id="cancel" name="cancel" >';
        }
        $hold = '';
        if( $data->parcel_status == "Hold")
        {
            $hold .= '
            <input type="image" id="hold" src="'.asset("Gray/checked.png").'" >
            ';
        } else {
            $hold .='
        <input type="checkbox"  id="hold" name="hold" >';
        }

        $output ='
     <table width="100%" border="0">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="10">
                <tr>
                    <td width="50%">
                        <table border="1" width="100%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>
                                    <h2>SHIP FROM :</h2>
                                    <h5>Date : ' . date('d M, Y', strtotime($data->created_at)) . '</h5>
                                    <h5> ' . $data->business_name . '</h5>
                                    <p>Address: ' . $data->business_address . '
                                    </p>
                                    <p>Phone : '. $data->mobile.'</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td width="50%">
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>
                                    <h2>SHIP TO :</h2>
                                    <h5>Date : '. date('d M, Y', strtotime($data->deliver_date)) . '</h5>
                                    <h5>' . $data->recipient_name . '</h5>
                                    <p>Address: ' . $data->address . ' </p>
                                    <p>Phone :  ' . $data->recipient_number . ' </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
    <tr>
        <td align="center">

            <h3 align="center">INSTRUCTION: DELIVARY SHOULD DONE BY '. date('d M, Y', strtotime($data->deliver_date)) . '</h3>
             <p>&nbsp;</p>
        </td>
    </tr>
  <tr>
      <td>
          <table width="80%" align="center" border="1" cellpadding="10" cellspacing="0">

              <tr>
                  <td>
                      <table width="100%" cellspacing="0" cellpadding="20">
                          <tr>
                              <td width="50%" align="center">
                                  <h3 style="border-inline-end: 3px solid #000000;">'. $data->payment_method_name . '</h3>
                              </td>
                              <td width="50%">
                                  <h3>'. $data->product_price . '</h3>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
      </td>
  </tr>

    <tr>
        <td>
            <table width="80%" align="center" border="0" cellpadding="20" cellspacing="0">

                <tr>
                    <td> 
                         '.$delivered.'              
                        <label for="delivered"> DELIVERED</label>
                    </td>
                    <td>
                        '.$cancel.'
                        <label for="cancelled"> CANCELLED</label>
                    </td>
                    <td>
                       '.$hold.'
                        <label for="hold"> HOLD</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="98%" align="center" border="1" cellpadding="10" cellspacing="0">

                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="10">
                            <tr>
                                <td width="50%">
                                    <h2>Borak Express</h2>
                                    <h4>Trakcing ID : '. $data->id . '</h4>
                                    <img src="'.asset("Gray/pdf_image.svg").'">
                                </td>
                                <td width="50%" align="center">
                                    <img src="'.asset("Gray/pdf_logo.svg").'">
                                    <p>Address: Jahan Villa, House: 36, Road: 1, Mohammadi Housing Limited, Dhaka-1207
                                    </p> 
                                    <p>Phone : +880-1794706299</p>

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
         <p>&nbsp;</p>
            <p align="center">NOTED: IF LOST, PLEASE RETURN TO BORAK EXPRESS</p>
            <p align="center">Address : Jahan Villa, House: 36, Road: 1, Mohammadi Housing Limited, Dhaka-1207</p>
        </td>
    </tr>
  </table>';
        return $output;
    }
//    pdf end
}
