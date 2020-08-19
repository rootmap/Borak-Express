<?php

namespace App\Http\Controllers;

use App\BookingArea;
use App\AdminLog;
use Illuminate\Http\Request;
use App\City;
                

class BookingAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Booking Area";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=BookingArea::all();
        return view('admin.pages.bookingarea.bookingarea_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_City=City::all();           
        return view('admin.pages.bookingarea.bookingarea_create',['dataRow_City'=>$tab_City]);
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
                
                'city_id'=>'required',
                'area_name'=>'required',
                'shipping_price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Booking Area","Save New","Create New");

        
        $tab_0_City=City::where('id',$request->city_id)->first();
        $city_id_0_City=$tab_0_City->name;
        $tab=new BookingArea();
        
        $tab->city_id_name=$city_id_0_City;
        $tab->city_id=$request->city_id;
        $tab->area_name=$request->area_name;
        $tab->shipping_price=$request->shipping_price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('bookingarea')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'city_id'=>'required',
                'area_name'=>'required',
                'shipping_price'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new BookingArea();
        
        $tab->city_id_name=$city_id_0_City;
        $tab->city_id=$request->city_id;
        $tab->area_name=$request->area_name;
        $tab->shipping_price=$request->shipping_price;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BookingArea  $bookingarea
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('city_id','LIKE','%'.$search.'%');
                            $query->orWhere('area_name','LIKE','%'.$search.'%');
                            $query->orWhere('shipping_price','LIKE','%'.$search.'%');
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
                            $query->orWhere('city_id','LIKE','%'.$search.'%');
                            $query->orWhere('area_name','LIKE','%'.$search.'%');
                            $query->orWhere('shipping_price','LIKE','%'.$search.'%');
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

    
    public function BookingAreaQuery($request)
    {
        $BookingArea_data=BookingArea::orderBy('id','DESC')->get();

        return $BookingArea_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','City ID','Area Name','Shipping Price','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->BookingAreaQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->city_id,$voi->area_name,$voi->shipping_price,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Booking Area Report',
            'report_title'=>'Booking Area Report',
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
                            <th class='text-center' style='font-size:12px;' >City ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Area Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Shipping Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->BookingAreaQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->city_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->area_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->shipping_price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Booking Area Report',$html);


    }
    public function show(BookingArea $bookingarea)
    {
        
        $tab=BookingArea::all();return view('admin.pages.bookingarea.bookingarea_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookingArea  $bookingarea
     * @return \Illuminate\Http\Response
     */
    public function edit(BookingArea $bookingarea,$id=0)
    {
        $tab=BookingArea::find($id); 
        $tab_City=City::all();     
        return view('admin.pages.bookingarea.bookingarea_edit',['dataRow_City'=>$tab_City,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookingArea  $bookingarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookingArea $bookingarea,$id=0)
    {
        $this->validate($request,[
                
                'city_id'=>'required',
                'area_name'=>'required',
                'shipping_price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Booking Area","Update","Edit / Modify");

        
        $tab_0_City=City::where('id',$request->city_id)->first();
        $city_id_0_City=$tab_0_City->name;
        $tab=BookingArea::find($id);
        
        $tab->city_id_name=$city_id_0_City;
        $tab->city_id=$request->city_id;
        $tab->area_name=$request->area_name;
        $tab->shipping_price=$request->shipping_price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('bookingarea')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookingArea  $bookingarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookingArea $bookingarea,$id=0)
    {
        $this->SystemAdminLog("Booking Area","Destroy","Delete");

        $tab=BookingArea::find($id);
        $tab->delete();
        return redirect('bookingarea')->with('status','Deleted Successfully !');}
}
