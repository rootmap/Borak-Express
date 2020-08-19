<?php

namespace App\Http\Controllers;

use App\MerchantMFS;
use App\AdminLog;
use Illuminate\Http\Request;
use App\MerchantInfo;
                
use App\WalletProvider;
                

class MerchantMFSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Merchant MFS";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=MerchantMFS::all();
        return view('admin.pages.merchantmfs.merchantmfs_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_MerchantInfo=MerchantInfo::all();
        $tab_WalletProvider=WalletProvider::all();           
        return view('admin.pages.merchantmfs.merchantmfs_create',['dataRow_MerchantInfo'=>$tab_MerchantInfo,'dataRow_WalletProvider'=>$tab_WalletProvider]);
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
                'wallet_provider_id'=>'required',
                'mobile_number'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant MFS","Save New","Create New");

        
        $tab_0_MerchantInfo=MerchantInfo::where('id',$request->merchant_id)->first();
        $merchant_id_0_MerchantInfo=$tab_0_MerchantInfo->full_name;
        $tab_1_WalletProvider=WalletProvider::where('id',$request->wallet_provider_id)->first();
        $wallet_provider_id_1_WalletProvider=$tab_1_WalletProvider->name;
        $tab=new MerchantMFS();
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->wallet_provider_id_name=$wallet_provider_id_1_WalletProvider;
        $tab->wallet_provider_id=$request->wallet_provider_id;
        $tab->mobile_number=$request->mobile_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('merchantmfs')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'merchant_id'=>'required',
                'wallet_provider_id'=>'required',
                'mobile_number'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new MerchantMFS();
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->wallet_provider_id_name=$wallet_provider_id_1_WalletProvider;
        $tab->wallet_provider_id=$request->wallet_provider_id;
        $tab->mobile_number=$request->mobile_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MerchantMFS  $merchantmfs
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('merchant_id','LIKE','%'.$search.'%');
                            $query->orWhere('wallet_provider_id','LIKE','%'.$search.'%');
                            $query->orWhere('mobile_number','LIKE','%'.$search.'%');
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
                            $query->orWhere('wallet_provider_id','LIKE','%'.$search.'%');
                            $query->orWhere('mobile_number','LIKE','%'.$search.'%');
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

    
    public function MerchantMFSQuery($request)
    {
        $MerchantMFS_data=MerchantMFS::orderBy('id','DESC')->get();

        return $MerchantMFS_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Merchant ID','Wallet Provider ID','Mobile Number','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->MerchantMFSQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->merchant_id,$voi->wallet_provider_id,$voi->mobile_number,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Merchant MFS Report',
            'report_title'=>'Merchant MFS Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Wallet Provider ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Mobile Number</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->MerchantMFSQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->merchant_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->wallet_provider_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->mobile_number."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Merchant MFS Report',$html);


    }
    public function show(MerchantMFS $merchantmfs)
    {
        
        $tab=MerchantMFS::all();return view('admin.pages.merchantmfs.merchantmfs_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MerchantMFS  $merchantmfs
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantMFS $merchantmfs,$id=0)
    {
        $tab=MerchantMFS::find($id); 
        $tab_MerchantInfo=MerchantInfo::all();
        $tab_WalletProvider=WalletProvider::all();     
        return view('admin.pages.merchantmfs.merchantmfs_edit',['dataRow_MerchantInfo'=>$tab_MerchantInfo,'dataRow_WalletProvider'=>$tab_WalletProvider,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MerchantMFS  $merchantmfs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MerchantMFS $merchantmfs,$id=0)
    {
        $this->validate($request,[
                
                'merchant_id'=>'required',
                'wallet_provider_id'=>'required',
                'mobile_number'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant MFS","Update","Edit / Modify");

        
        $tab_0_MerchantInfo=MerchantInfo::where('id',$request->merchant_id)->first();
        $merchant_id_0_MerchantInfo=$tab_0_MerchantInfo->full_name;
        $tab_1_WalletProvider=WalletProvider::where('id',$request->wallet_provider_id)->first();
        $wallet_provider_id_1_WalletProvider=$tab_1_WalletProvider->name;
        $tab=MerchantMFS::find($id);
        
        $tab->merchant_id_full_name=$merchant_id_0_MerchantInfo;
        $tab->merchant_id=$request->merchant_id;
        $tab->wallet_provider_id_name=$wallet_provider_id_1_WalletProvider;
        $tab->wallet_provider_id=$request->wallet_provider_id;
        $tab->mobile_number=$request->mobile_number;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('merchantmfs')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MerchantMFS  $merchantmfs
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantMFS $merchantmfs,$id=0)
    {
        $this->SystemAdminLog("Merchant MFS","Destroy","Delete");

        $tab=MerchantMFS::find($id);
        $tab->delete();
        return redirect('merchantmfs')->with('status','Deleted Successfully !');}
}
