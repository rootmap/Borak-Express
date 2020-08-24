<?php

namespace App\Http\Controllers;

use App\ShippingCost;
use App\AdminLog;
use Illuminate\Http\Request;
use App\BookingDeliveryType;
                
use App\BookingPackage;
                
use App\City;
                
use App\BookingArea;
                

class ShippingCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Shipping Cost";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=ShippingCost::all();
        return view('admin.pages.shippingcost.shippingcost_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();           
        return view('admin.pages.shippingcost.shippingcost_create',['dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea]);
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
                
                'delivery_type'=>'required',
                'package_weight'=>'required',
                'delivery_city'=>'required',
                'delivery_area'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Shipping Cost","Save New","Create New");

        
        $tab_0_BookingDeliveryType=BookingDeliveryType::where('id',$request->delivery_type)->first();
        $delivery_type_0_BookingDeliveryType=$tab_0_BookingDeliveryType->name;
        $tab_1_BookingPackage=BookingPackage::where('id',$request->package_weight)->first();
        $package_weight_1_BookingPackage=$tab_1_BookingPackage->name;
        $tab_2_City=City::where('id',$request->delivery_city)->first();
        $delivery_city_2_City=$tab_2_City->name;
        $tab_3_BookingArea=BookingArea::where('id',$request->delivery_area)->first();
        $delivery_area_3_BookingArea=$tab_3_BookingArea->area_name;
        $tab=new ShippingCost();
        
        $tab->delivery_type_name=$delivery_type_0_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_weight_name=$package_weight_1_BookingPackage;
        $tab->package_weight=$request->package_weight;
        $tab->delivery_city_name=$delivery_city_2_City;
        $tab->delivery_city=$request->delivery_city;
        $tab->delivery_area_area_name=$delivery_area_3_BookingArea;
        $tab->delivery_area=$request->delivery_area;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('shippingcost')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'delivery_type'=>'required',
                'package_weight'=>'required',
                'delivery_city'=>'required',
                'delivery_area'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new ShippingCost();
        
        $tab->delivery_type_name=$delivery_type_0_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_weight_name=$package_weight_1_BookingPackage;
        $tab->package_weight=$request->package_weight;
        $tab->delivery_city_name=$delivery_city_2_City;
        $tab->delivery_city=$request->delivery_city;
        $tab->delivery_area_area_name=$delivery_area_3_BookingArea;
        $tab->delivery_area=$request->delivery_area;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShippingCost  $shippingcost
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_type','LIKE','%'.$search.'%');
                            $query->orWhere('package_weight','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_city','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_area','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('delivery_type','LIKE','%'.$search.'%');
                            $query->orWhere('package_weight','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_city','LIKE','%'.$search.'%');
                            $query->orWhere('delivery_area','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
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

    
    public function ShippingCostQuery($request)
    {
        $ShippingCost_data=ShippingCost::orderBy('id','DESC')->get();

        return $ShippingCost_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Delivery Type','Package Weight','Delivery City','Delivery Area','Price','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ShippingCostQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->delivery_type,$voi->package_weight,$voi->delivery_city,$voi->delivery_area,$voi->price,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Shipping Cost Report',
            'report_title'=>'Shipping Cost Report',
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
                            <th class='text-center' style='font-size:12px;' >Delivery Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Package Weight</th>
                        
                            <th class='text-center' style='font-size:12px;' >Delivery City</th>
                        
                            <th class='text-center' style='font-size:12px;' >Delivery Area</th>
                        
                            <th class='text-center' style='font-size:12px;' >Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ShippingCostQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_type."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->package_weight."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_city."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->delivery_area."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Shipping Cost Report',$html);


    }
    public function show(ShippingCost $shippingcost)
    {
        
        $tab=ShippingCost::all();return view('admin.pages.shippingcost.shippingcost_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShippingCost  $shippingcost
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingCost $shippingcost,$id=0)
    {
        $tab=ShippingCost::find($id); 
        $tab_BookingDeliveryType=BookingDeliveryType::all();
        $tab_BookingPackage=BookingPackage::all();
        $tab_City=City::all();
        $tab_BookingArea=BookingArea::all();     
        return view('admin.pages.shippingcost.shippingcost_edit',['dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'dataRow_City'=>$tab_City,'dataRow_BookingArea'=>$tab_BookingArea,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShippingCost  $shippingcost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShippingCost $shippingcost,$id=0)
    {
        $this->validate($request,[
                
                'delivery_type'=>'required',
                'package_weight'=>'required',
                'delivery_city'=>'required',
                'delivery_area'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Shipping Cost","Update","Edit / Modify");

        
        $tab_0_BookingDeliveryType=BookingDeliveryType::where('id',$request->delivery_type)->first();
        $delivery_type_0_BookingDeliveryType=$tab_0_BookingDeliveryType->name;
        $tab_1_BookingPackage=BookingPackage::where('id',$request->package_weight)->first();
        $package_weight_1_BookingPackage=$tab_1_BookingPackage->name;
        $tab_2_City=City::where('id',$request->delivery_city)->first();
        $delivery_city_2_City=$tab_2_City->name;
        $tab_3_BookingArea=BookingArea::where('id',$request->delivery_area)->first();
        $delivery_area_3_BookingArea=$tab_3_BookingArea->area_name;
        $tab=ShippingCost::find($id);
        
        $tab->delivery_type_name=$delivery_type_0_BookingDeliveryType;
        $tab->delivery_type=$request->delivery_type;
        $tab->package_weight_name=$package_weight_1_BookingPackage;
        $tab->package_weight=$request->package_weight;
        $tab->delivery_city_name=$delivery_city_2_City;
        $tab->delivery_city=$request->delivery_city;
        $tab->delivery_area_area_name=$delivery_area_3_BookingArea;
        $tab->delivery_area=$request->delivery_area;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('shippingcost')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShippingCost  $shippingcost
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingCost $shippingcost,$id=0)
    {
        $this->SystemAdminLog("Shipping Cost","Destroy","Delete");

        $tab=ShippingCost::find($id);
        $tab->delete();
        return redirect('shippingcost')->with('status','Deleted Successfully !');}
}
