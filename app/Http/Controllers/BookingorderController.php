<?php

namespace App\Http\Controllers;

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
use Auth;
                

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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $status='';
        if(isset($request->status))
        {
            $status=$request->status;
        }

        if(Auth::user()->user_type_id==1)
        {
            $tab=BookingOrder::orderBy('id','DESC')
                ->when($search, function ($query) use ($search) {
                              
                    $query->whereRaw("(id LIKE '%".$search."%' OR recipient_number LIKE '%".$search."%' OR 
                    recipient_name LIKE '%".$search."%' OR 
                    package_id LIKE '%".$search."%')");

                    return $query;
                })
                ->when($dateString, function ($query) use ($dateString) {
                        return $query->whereRaw($dateString);
                })
                ->when($status, function ($query) use ($status) {
                        return $query->where('parcel_status',$status);
                })
                ->take(50)
                ->get();
        }
        else
        {
            $tab=BookingOrder::where('created_by',$this->sdc->UserID())
                            ->when($search, function ($query) use ($search) {
                                            
                                $query->whereRaw("(id LIKE '%".$search."%' OR recipient_number LIKE '%".$search."%' OR 
                                recipient_name LIKE '%".$search."%' OR 
                                package_id LIKE '%".$search."%')");

                                return $query;
                            })
                            ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                            })
                            ->when($status, function ($query) use ($status) {
                                    return $query->where('parcel_status',$status);
                            })
                            ->orderBy('id','DESC')
                            ->take(50)
                            ->get();
        }


        //dd($tab);
        
        return view('admin.pages.bookingorder.bookingorder_search',['dataRow'=>$tab,'search'=>$request->search,'start_date'=>$start_date,'end_date'=>$request->end_time,'status'=>$status]);
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $status='';
        if(isset($request->status))
        {
            $status=$request->status;
        }

        if(Auth::user()->user_type_id==1)
        {
            $tab=BookingOrder::orderBy('id','DESC')
                ->when($search, function ($query) use ($search) {
                              
                    $query->whereRaw("(id LIKE '%".$search."%' OR recipient_number LIKE '%".$search."%' OR 
                    recipient_name LIKE '%".$search."%' OR 
                    package_id LIKE '%".$search."%')");

                    return $query;
                })
                ->when($dateString, function ($query) use ($dateString) {
                        return $query->whereRaw($dateString);
                })
                ->when($status, function ($query) use ($status) {
                        return $query->where('parcel_status',$status);
                })
                ->get();
        }
        else
        {
            $tab=BookingOrder::where('created_by',$this->sdc->UserID())
                            ->when($search, function ($query) use ($search) {
                                            
                                $query->whereRaw("(id LIKE '%".$search."%' OR recipient_number LIKE '%".$search."%' OR 
                                recipient_name LIKE '%".$search."%' OR 
                                package_id LIKE '%".$search."%')");

                                return $query;
                            })
                            ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                            })
                            ->when($status, function ($query) use ($status) {
                                    return $query->where('parcel_status',$status);
                            })
                            ->orderBy('id','DESC')
                            ->get();
        }

        return $tab;
    }

    public function exportFilterExcel(Request $request){
        $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Sending Type','Recipient Number','Recipient Name','Address','Recipient City','Recipient Area','Landmarks','Product ID','Parcel Type','Delivery Type','Package ID','Product Price','Deliver Date','No of Items','Parcel Status','Payment Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->filterExport($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,
                                $voi->sending_type_name,
                                $voi->recipient_number,
                                $voi->recipient_name,
                                $voi->address,
                                $voi->recipient_city_name,
                                $voi->recipient_area_area_name,
                                $voi->landmarks,
                                $voi->product_id,
                                $voi->parcel_type_name,
                                $voi->delivery_type_name,
                                $voi->package_id_name,
                                $voi->product_price,
                                $voi->deliver_date,
                                $voi->no_of_items,
                                $voi->parcel_status,
                                $voi->payment_status,
                                formatDate($voi->created_at));
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
                            <th class='text-center' style='font-size:12px;' >Sending Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Number</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient City</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Area</th>
                        
                            <th class='text-center' style='font-size:12px;' >Landmarks</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Parcel Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Delivery Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Package ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product Price</th>
                        
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
                        <td style='font-size:12px;' class='text-center'>".$voi->sending_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_city_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_area_area_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->landmarks."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->package_id_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->deliver_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->no_of_items."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_status."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Order Report',$html);
    }

    public function index(){
        if(Auth::user()->user_type_id==1)
        {
            $tab=BookingOrder::orderBy('id','DESC')->get();
        }
        else
        {
            $tab=BookingOrder::where('created_by',$this->sdc->UserID())->orderBy('id','DESC')->get();
        }


        //dd($tab);
        
        return view('admin.pages.bookingorder.bookingorder_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_ItemType=ItemType::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();
        $tab_ItemType=ItemType::all();
        $tab_SendingType=SendingType::all();
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();           
        $tab_PaymentMethod=PaymentMethod::all();           
        return view('admin.pages.bookingorder.bookingorder_create',['dataRow_ItemType'=>$tab_ItemType,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea,
        'dataRow_ItemType'=>$tab_ItemType,
        'dataRow_SendingType'=>$tab_SendingType,
        'dataRow_PaymentMethod'=>$tab_PaymentMethod,
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

        if (Auth::user()->user_type_id==1) {
            $this->validate($request,[
                'parcel_status'=>'required',
            ]);
            $parcel_status=$request->parcel_status;    
            $payment_status=$request->payment_status;    
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
        $tab->parcel_status=$parcel_status;
        $tab->payment_method=$request->payment_method;
        $tab->payment_method_name=$PaymentMethod_name;
        $tab->shipping_cost=$request->shipping_cost;
        $tab->total_charge=$request->total_charge;
        $tab->payment_status=$payment_status;
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

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
            $BookingOrder_data=BookingOrder::orderBy('id','DESC')->get();
        }
        else
        {
            $BookingOrder_data=BookingOrder::where('created_by',$this->sdc->UserID())->orderBy('id','DESC')->get();
        }

        return $BookingOrder_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Sending Type','Recipient Number','Recipient Name','Address','Recipient City','Recipient Area','Landmarks','Product ID','Parcel Type','Delivery Type','Package ID','Product Price','Deliver Date','No of Items','Parcel Status','Payment Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->BookingOrderQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,
                                $voi->sending_type_name,
                                $voi->recipient_number,
                                $voi->recipient_name,
                                $voi->address,
                                $voi->recipient_city_name,
                                $voi->recipient_area_area_name,
                                $voi->landmarks,
                                $voi->product_id,
                                $voi->parcel_type_name,
                                $voi->delivery_type_name,
                                $voi->package_id_name,
                                $voi->product_price,
                                $voi->deliver_date,
                                $voi->no_of_items,$voi->parcel_status,$voi->payment_status,formatDate($voi->created_at));
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

        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Sending Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Number</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient City</th>
                        
                            <th class='text-center' style='font-size:12px;' >Recipient Area</th>
                        
                            <th class='text-center' style='font-size:12px;' >Landmarks</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Parcel Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Delivery Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Package ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Product Price</th>
                        
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
                        <td style='font-size:12px;' class='text-center'>".$voi->sending_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_city_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->recipient_area_area_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->landmarks."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_type_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->package_id_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->product_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->deliver_date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->no_of_items."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->parcel_status."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Order Report',$html);


    }
    public function show(BookingOrder $bookingorder)
    {
        
        if(Auth::user()->user_type_id==1)
        {
            $tab=BookingOrder::orderBy('id','DESC')->get();
        }
        else
        {
            $tab=BookingOrder::where('created_by',$this->sdc->UserID())->orderBy('id','DESC')->get();
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
        $tab_ItemType=ItemType::all();
        $tab_SendingType=SendingType::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();
        $tab_ItemType=ItemType::all();
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();     
        $tab_PaymentMethod=PaymentMethod::all();   
        return view('admin.pages.bookingorder.bookingorder_edit',[
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_City'=>$tab_City,
            'dataRow_BookingArea'=>$tab_BookingArea,
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_SendingType'=>$tab_SendingType,
            'dataRow_PaymentMethod'=>$tab_PaymentMethod,
            'dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'dataRow'=>$tab,'edit'=>true]);  
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
        return view('admin.pages.bookingorder.bookingorder_view',['dataRow_ItemType'=>$tab_ItemType,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea,
        'dataRow_ItemType'=>$tab_ItemType,
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

        if (Auth::user()->user_type_id==1) {
            $this->validate($request,[
                'parcel_status'=>'required',
            ]);
            $parcel_status=$request->parcel_status;    
            $payment_status=$request->payment_status;    
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
        $tab->payment_method=$request->payment_method;
        $tab->payment_method_name=$PaymentMethod_name;
        $tab->shipping_cost=$request->shipping_cost;
        $tab->total_charge=$request->total_charge;
        $tab->parcel_status=$parcel_status;
        $tab->payment_status=$payment_status;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

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
        return redirect('bookingorder')->with('status','Deleted Successfully !');}
}
