<?php

namespace App\Http\Controllers;

use App\RPAEraseVoucherReport;
use App\AdminLog;
use Illuminate\Http\Request;

class RPAEraseVoucherReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="RPA Erase Voucher Report";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=RPAEraseVoucherReport::all();
        return view('admin.pages.rpaerasevoucherreport.rpaerasevoucherreport_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.rpaerasevoucherreport.rpaerasevoucherreport_create');
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
                
                'msisdn'=>'required',
                'customer_name'=>'required',
                'gender'=>'required',
                'account_status'=>'required',
        ]);

        $this->SystemAdminLog("RPA Erase Voucher Report","Save New","Create New");

        
        $tab=new RPAEraseVoucherReport();
        
        $tab->msisdn=$request->msisdn;
        $tab->customer_name=$request->customer_name;
        $tab->gender=$request->gender;
        $tab->account_status=$request->account_status;
        $tab->save();

        return redirect('rpaerasevoucherreport')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'msisdn'=>'required',
                'customer_name'=>'required',
                'gender'=>'required',
                'account_status'=>'required',
        ]);

        $tab=new RPAEraseVoucherReport();
        
        $tab->msisdn=$request->msisdn;
        $tab->customer_name=$request->customer_name;
        $tab->gender=$request->gender;
        $tab->account_status=$request->account_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RPAEraseVoucherReport  $rpaerasevoucherreport
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('msisdn','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('gender','LIKE','%'.$search.'%');
                            $query->orWhere('account_status','LIKE','%'.$search.'%');
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
                            $query->orWhere('msisdn','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('gender','LIKE','%'.$search.'%');
                            $query->orWhere('account_status','LIKE','%'.$search.'%');
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

    
    public function RPAEraseVoucherReportQuery($request)
    {
        $RPAEraseVoucherReport_data=RPAEraseVoucherReport::orderBy('id','DESC')->get();

        return $RPAEraseVoucherReport_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','MSISDN','Customer Name','Gender','Account Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->RPAEraseVoucherReportQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->msisdn,$voi->customer_name,$voi->gender,$voi->account_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'RPA Erase Voucher Report Report',
            'report_title'=>'RPA Erase Voucher Report Report',
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
                            <th class='text-center' style='font-size:12px;' >MSISDN</th>
                        
                            <th class='text-center' style='font-size:12px;' >Customer Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Gender</th>
                        
                            <th class='text-center' style='font-size:12px;' >Account Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->RPAEraseVoucherReportQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->msisdn."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->customer_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->gender."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->account_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('RPA Erase Voucher Report Report',$html);


    }
    public function show(RPAEraseVoucherReport $rpaerasevoucherreport)
    {
        
        $tab=RPAEraseVoucherReport::all();return view('admin.pages.rpaerasevoucherreport.rpaerasevoucherreport_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RPAEraseVoucherReport  $rpaerasevoucherreport
     * @return \Illuminate\Http\Response
     */
    public function edit(RPAEraseVoucherReport $rpaerasevoucherreport,$id=0)
    {
        $tab=RPAEraseVoucherReport::find($id);      
        return view('admin.pages.rpaerasevoucherreport.rpaerasevoucherreport_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RPAEraseVoucherReport  $rpaerasevoucherreport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RPAEraseVoucherReport $rpaerasevoucherreport,$id=0)
    {
        $this->validate($request,[
                
                'msisdn'=>'required',
                'customer_name'=>'required',
                'gender'=>'required',
                'account_status'=>'required',
        ]);

        $this->SystemAdminLog("RPA Erase Voucher Report","Update","Edit / Modify");

        
        $tab=RPAEraseVoucherReport::find($id);
        
        $tab->msisdn=$request->msisdn;
        $tab->customer_name=$request->customer_name;
        $tab->gender=$request->gender;
        $tab->account_status=$request->account_status;
        $tab->save();

        return redirect('rpaerasevoucherreport')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RPAEraseVoucherReport  $rpaerasevoucherreport
     * @return \Illuminate\Http\Response
     */
    public function destroy(RPAEraseVoucherReport $rpaerasevoucherreport,$id=0)
    {
        $this->SystemAdminLog("RPA Erase Voucher Report","Destroy","Delete");

        $tab=RPAEraseVoucherReport::find($id);
        $tab->delete();
        return redirect('rpaerasevoucherreport')->with('status','Deleted Successfully !');}
}
