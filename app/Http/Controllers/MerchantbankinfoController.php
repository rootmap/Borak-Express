<?php

namespace App\Http\Controllers;

use App\MerchantBankInfo;
use App\AdminLog;
use Illuminate\Http\Request;
use App\MerchantInfo;
                

class MerchantBankInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Merchant Bank Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=MerchantBankInfo::all();
        return view('admin.pages.merchantbankinfo.merchantbankinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_MerchantInfo=MerchantInfo::all();           
        return view('admin.pages.merchantbankinfo.merchantbankinfo_create',['dataRow_MerchantInfo'=>$tab_MerchantInfo]);
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
                
                'merchant_id'=>'required',
                'bank_name'=>'required',
                'bank_branch'=>'required',
                'account_type'=>'required',
                'account_name'=>'required',
                'account_number'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant Bank Info","Save New","Create New");

        
        $tab_0_MerchantInfo=MerchantInfo::where('id',$request->merchant_id)->first();
        $merchant_id_0_MerchantInfo=$tab_0_MerchantInfo->full_name;
        $tab=new MerchantBankInfo();
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->bank_name=$request->bank_name;
        $tab->bank_branch=$request->bank_branch;
        $tab->account_type=$request->account_type;
        $tab->account_name=$request->account_name;
        $tab->account_number=$request->account_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('merchantbankinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'merchant_id'=>'required',
                'bank_name'=>'required',
                'bank_branch'=>'required',
                'account_type'=>'required',
                'account_name'=>'required',
                'account_number'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new MerchantBankInfo();
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->bank_name=$request->bank_name;
        $tab->bank_branch=$request->bank_branch;
        $tab->account_type=$request->account_type;
        $tab->account_name=$request->account_name;
        $tab->account_number=$request->account_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MerchantBankInfo  $merchantbankinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('merchant_id','LIKE','%'.$search.'%');
                            $query->orWhere('bank_name','LIKE','%'.$search.'%');
                            $query->orWhere('bank_branch','LIKE','%'.$search.'%');
                            $query->orWhere('account_type','LIKE','%'.$search.'%');
                            $query->orWhere('account_name','LIKE','%'.$search.'%');
                            $query->orWhere('account_number','LIKE','%'.$search.'%');
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
                            $query->orWhere('merchant_id','LIKE','%'.$search.'%');
                            $query->orWhere('bank_name','LIKE','%'.$search.'%');
                            $query->orWhere('bank_branch','LIKE','%'.$search.'%');
                            $query->orWhere('account_type','LIKE','%'.$search.'%');
                            $query->orWhere('account_name','LIKE','%'.$search.'%');
                            $query->orWhere('account_number','LIKE','%'.$search.'%');
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

    
    public function MerchantBankInfoQuery($request)
    {
        $MerchantBankInfo_data=MerchantBankInfo::orderBy('id','DESC')->get();

        return $MerchantBankInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Merchant ID','Bank Name','Bank Branch','Account Type','Account Name','Account Number','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->MerchantBankInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->merchant_id,$voi->bank_name,$voi->bank_branch,$voi->account_type,$voi->account_name,$voi->account_number,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Merchant Bank Info Report',
            'report_title'=>'Merchant Bank Info Report',
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
                            <th class='text-center' style='font-size:12px;' >Merchant ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Bank Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Bank Branch</th>
                        
                            <th class='text-center' style='font-size:12px;' >Account Type</th>
                        
                            <th class='text-center' style='font-size:12px;' >Account Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Account Number</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->MerchantBankInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->merchant_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->bank_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->bank_branch."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->account_type."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->account_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->account_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Merchant Bank Info Report',$html);


    }
    public function show(MerchantBankInfo $merchantbankinfo)
    {
        
        $tab=MerchantBankInfo::all();return view('admin.pages.merchantbankinfo.merchantbankinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MerchantBankInfo  $merchantbankinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantBankInfo $merchantbankinfo,$id=0)
    {
        $tab=MerchantBankInfo::find($id); 
        $tab_MerchantInfo=MerchantInfo::all();     
        return view('admin.pages.merchantbankinfo.merchantbankinfo_edit',['dataRow_MerchantInfo'=>$tab_MerchantInfo,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MerchantBankInfo  $merchantbankinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MerchantBankInfo $merchantbankinfo,$id=0)
    {
        $this->validate($request,[
                
                'merchant_id'=>'required',
                'bank_name'=>'required',
                'bank_branch'=>'required',
                'account_type'=>'required',
                'account_name'=>'required',
                'account_number'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant Bank Info","Update","Edit / Modify");

        
        $tab_0_MerchantInfo=MerchantInfo::where('id',$request->merchant_id)->first();
        $merchant_id_0_MerchantInfo=$tab_0_MerchantInfo->full_name;
        $tab=MerchantBankInfo::find($id);
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->bank_name=$request->bank_name;
        $tab->bank_branch=$request->bank_branch;
        $tab->account_type=$request->account_type;
        $tab->account_name=$request->account_name;
        $tab->account_number=$request->account_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('merchantbankinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MerchantBankInfo  $merchantbankinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantBankInfo $merchantbankinfo,$id=0)
    {
        $this->SystemAdminLog("Merchant Bank Info","Destroy","Delete");

        $tab=MerchantBankInfo::find($id);
        $tab->delete();
        return redirect('merchantbankinfo')->with('status','Deleted Successfully !');}
}
