<?php

namespace App\Http\Controllers;

use App\MerchantInfo;
use App\AdminLog;
use Illuminate\Http\Request;
use App\PaymentType;
use App\WalletProvider;
use App\MerchantMFS;
use App\MerchantBankInfo;
use App\User;
use App\BankAccountType;
use Auth;                

class MerchantInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Merchant Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=MerchantInfo::all();
        return view('admin.pages.merchantinfo.merchantinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_PaymentType=PaymentType::all();           
        $tab_WalletProvider=WalletProvider::all();           
        return view('admin.pages.merchantinfo.merchantinfo_create',[
            'dataRow_PaymentType'=>$tab_PaymentType,
            'wp'=>$tab_WalletProvider
            ]);
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


    public function signup(Request $request)
    {
       // dd($request);
        $validator = \Validator::make($request->all(), [
            'full_name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'password'=>'required',
            'business_name'=>'required',
            'business_address'=>'required',
            'pickup_address'=>'required',
            'payment_method'=>'required',
        ]);


        if (!$validator->passes()) {
			return response()->json(['error'=>'Please fillup all fields.']);
        }

        $checkMerchant=MerchantInfo::where('email',$request->email)->count();
        if($checkMerchant>0)
        {
            return response()->json(['error'=>'Merchant email already exists, please use different email.']);
        }

        $checkUsers=\DB::table('users')->where('email',$request->email)->count();
        if($checkUsers>0)
        {
            return response()->json(['error'=>'Email already in use, please use different email.']);
        }

        $this->SystemAdminLog("Merchant Info","Save New","Create New account from site");



        try{

            try{
                $tab_7_PaymentType=PaymentType::where('id',$request->payment_method)->first();
                $payment_method_7_PaymentType=$tab_7_PaymentType->name;
                $tab=new MerchantInfo();
                $tab->full_name=$request->full_name;
                $tab->mobile=$request->mobile;
                $tab->email=$request->email;
                $tab->password=$request->password;
                $tab->business_name=$request->business_name;
                $tab->business_address=$request->business_address;
                $tab->pickup_address=$request->pickup_address;
                $tab->payment_method_name=$payment_method_7_PaymentType;
                $tab->payment_method=$request->payment_method;
                $tab->save();
                $merchant_id=$tab->id;
                $pm=$request->payment_method;
                if($pm==1)
                {

                    $wp=WalletProvider::find($request->wallet_provider_id);
                    $nmf=new MerchantMFS();
                    $nmf->merchant_id=$request->merchant_id;
                    $nmf->merchant_id_full_name=$request->full_name;
                    $nmf->wallet_provider_id=$request->wallet_provider_id;
                    $nmf->wallet_provider_id_name=$wp->name;
                    $nmf->mobile_number=$request->wallet_no;
                    $nmf->save();
                }
                elseif($pm==2)
                {
                    $wp_ac_type=BankAccountType::find($request->account_type);
                    $nmf=new MerchantBankInfo();
                    $nmf->merchant_id=$request->merchant_id;
                    $nmf->merchant_id_full_name=$request->full_name;
                    $nmf->bank_name=$request->bank_name;
                    $nmf->bank_branch=$request->branch;
                    $nmf->account_type=$request->account_type;
                    $nmf->account_type_name=$wp_ac_type->name;
                    $nmf->account_name=$request->ac_name;
                    $nmf->account_number=$request->ac_no;
                    $nmf->save();
                }

                $user = new User();
                $user->name = $request->full_name;
                $user->email = $request->email;
                $user->password = \Hash::make($request->password);
                $user->user_type_id = 2;
                $user->user_type_name = "Merchant";
                $user->save();

            } catch (\Exception $e) {
                return response()->json(['error'=>$e->getMessage()]);
            }

            if($user->id)
            {
                if (\Auth::attempt(['email' => trim($request->email),
                            'password' => $request->password,
                                ],false)) {


                    return response()->json(['redirect' => true, 'success' => 1], 200);
                } else {
                    $message = 'Invalid username or password';

                    return response()->json(['success' =>1], 200);
                }
            }
            

            return response()->json(['success'=>1]);


        } catch (\Exception $e) {
            return response()->json(['error'=>$e->getMessage()]);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request,[
                
                'full_name'=>'required',
                'mobile'=>'required',
                'email'=>'required',
                'password'=>'required',
                'business_name'=>'required',
                'business_address'=>'required',
                'pickup_address'=>'required',
                'payment_method'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant Info","Save New","Create New");

        
        $tab_7_PaymentType=PaymentType::where('id',$request->payment_method)->first();
        $payment_method_7_PaymentType=$tab_7_PaymentType->name;
        $tab=new MerchantInfo();
        
        $tab->full_name=$request->full_name;
        $tab->mobile=$request->mobile;
        $tab->email=$request->email;
        $tab->password=$request->password;
        $tab->business_name=$request->business_name;
        $tab->business_address=$request->business_address;
        $tab->pickup_address=$request->pickup_address;
        $tab->payment_method_name=$payment_method_7_PaymentType;
        $tab->payment_method=$request->payment_method;
        $tab->module_status=$request->module_status;
        $tab->save();
        $merchant_id=$tab->id;
        $pm=$request->payment_method;
        if($pm==1)
        {

            $wp=WalletProvider::find($request->wallet_provider_id);
            $nmf=new MerchantMFS();
            $nmf->merchant_id=$request->merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->wallet_provider_id=$request->wallet_provider_id;
            $nmf->wallet_provider_id_name=$wp->name;
            $nmf->mobile_number=$request->wallet_no;
            $nmf->save();
        }
        elseif($pm==2)
        {
            $wp_ac_type=BankAccountType::find($request->ac_type);
            $nmf=new MerchantBankInfo();
            $nmf->merchant_id=$request->merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->bank_name=$request->bank_name;
            $nmf->bank_branch=$request->branch;
            $nmf->account_type=$request->ac_type;
            $nmf->account_type_name=$wp_ac_type->name;
            $nmf->account_name=$request->ac_name;
            $nmf->account_number=$request->ac_no;
            $nmf->save();
        }
        return redirect('merchantinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'full_name'=>'required',
                'mobile'=>'required',
                'email'=>'required',
                'password'=>'required',
                'business_name'=>'required',
                'business_address'=>'required',
                'pickup_address'=>'required',
                'payment_method'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new MerchantInfo();
        
        $tab->full_name=$request->full_name;
        $tab->mobile=$request->mobile;
        $tab->email=$request->email;
        $tab->password=$request->password;
        $tab->business_name=$request->business_name;
        $tab->business_address=$request->business_address;
        $tab->pickup_address=$request->pickup_address;
        $tab->payment_method_name=$payment_method_7_PaymentType;
        $tab->payment_method=$request->payment_method;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MerchantInfo  $merchantinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('full_name','LIKE','%'.$search.'%');
                            $query->orWhere('mobile','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('password','LIKE','%'.$search.'%');
                            $query->orWhere('business_name','LIKE','%'.$search.'%');
                            $query->orWhere('business_address','LIKE','%'.$search.'%');
                            $query->orWhere('pickup_address','LIKE','%'.$search.'%');
                            $query->orWhere('payment_method','LIKE','%'.$search.'%');
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
                            $query->orWhere('full_name','LIKE','%'.$search.'%');
                            $query->orWhere('mobile','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('password','LIKE','%'.$search.'%');
                            $query->orWhere('business_name','LIKE','%'.$search.'%');
                            $query->orWhere('business_address','LIKE','%'.$search.'%');
                            $query->orWhere('pickup_address','LIKE','%'.$search.'%');
                            $query->orWhere('payment_method','LIKE','%'.$search.'%');
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

    
    public function MerchantInfoQuery($request)
    {
        $MerchantInfo_data=MerchantInfo::orderBy('id','DESC')->get();

        return $MerchantInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Full Name','Mobile','Email','Password','Business Name','Business Address','Pickup Address','Payment Method','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->MerchantInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->full_name,$voi->mobile,$voi->email,$voi->password,$voi->business_name,$voi->business_address,$voi->pickup_address,$voi->payment_method,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Merchant Info Report',
            'report_title'=>'Merchant Info Report',
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
                            <th class='text-center' style='font-size:12px;' >Full Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Mobile</th>
                        
                            <th class='text-center' style='font-size:12px;' >Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Password</th>
                        
                            <th class='text-center' style='font-size:12px;' >Business Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Business Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Pickup Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Payment Method</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->MerchantInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->full_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->mobile."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->password."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->business_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->business_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->pickup_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->payment_method."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Merchant Info Report',$html);


    }
    public function show(MerchantInfo $merchantinfo)
    {
        
        $tab=MerchantInfo::all();return view('admin.pages.merchantinfo.merchantinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MerchantInfo  $merchantinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantInfo $merchantinfo,$id=0)
    {
        $tab=MerchantInfo::find($id); 
        $tab_PaymentType=PaymentType::all();     
        $tab_WalletProvider=WalletProvider::all();     
        $tab_MerchantMFS=MerchantMFS::where('merchant_id',$id)->where('module_status','Active')->first();  
        $tab_MerchantBankInfo=MerchantBankInfo::where('merchant_id',$id)->where('module_status','Active')->first();  
        return view('admin.pages.merchantinfo.merchantinfo_edit',[
            'dataRow_PaymentType'=>$tab_PaymentType,
            'wp'=>$tab_WalletProvider,
            'wp_mfs'=>$tab_MerchantMFS,
            'wp_bank'=>$tab_MerchantBankInfo,
            'dataRow'=>$tab,'edit'=>true]);  
    }


    public function userProfile()
    {
        $email=Auth::user()->email;
        $tab=MerchantInfo::where('email',$email)->first(); 
        $tab_PaymentType=PaymentType::all();     
        $tab_WalletProvider=WalletProvider::all();     
        $tab_MerchantMFS=MerchantMFS::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        $tab_MerchantBankInfo=MerchantBankInfo::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        return view('admin.pages.merchantinfo.merchantinfo_profile',[
            'dataRow_PaymentType'=>$tab_PaymentType,
            'wp'=>$tab_WalletProvider,
            'wp_mfs'=>$tab_MerchantMFS,
            'wp_bank'=>$tab_MerchantBankInfo,
            'dataRow'=>$tab,'edit'=>true]);  
    }

    public function updateProfile(Request $request)
    {
        //dd($request);
        $email=Auth::user()->email;
        $tab_7_PaymentType=PaymentType::where('id',$request->payment_method)->first();
        $payment_method_7_PaymentType=$tab_7_PaymentType->name;
        $tab=MerchantInfo::where('email',$email)->first(); 
        $tab->full_name=$request->full_name;
        $tab->mobile=$request->mobile;
        $tab->email=$request->email;
        $tab->business_name=$request->business_name;
        $tab->business_address=$request->business_address;
        $tab->pickup_address=$request->pickup_address;
        $tab->payment_method_name=$payment_method_7_PaymentType;
        $tab->payment_method=$request->payment_method;
        $tab->save();
        $merchant_id=$tab->id;
        $pm=$request->payment_method;
        if($pm==1)
        {

            $wp=WalletProvider::find($request->wallet_provider_id);
            MerchantMFS::where('merchant_id',$merchant_id)->delete();
            $nmf=new MerchantMFS();
            $nmf->merchant_id=$merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->wallet_provider_id=$request->wallet_provider_id;
            $nmf->wallet_provider_id_name=$wp->name;
            $nmf->mobile_number=$request->wallet_no;
            $nmf->save();
        }
        elseif($pm==2)
        {
            MerchantBankInfo::where('merchant_id',$merchant_id)->delete();
            $wp_ac_type=BankAccountType::find($request->ac_type);
            $nmf=new MerchantBankInfo();
            $nmf->merchant_id=$merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->bank_name=$request->bank_name;
            $nmf->bank_branch=$request->branch;
            $nmf->account_type=$request->ac_type;
            $nmf->account_type_name=$wp_ac_type->name;
            $nmf->account_name=$request->ac_name;
            $nmf->account_number=$request->ac_no;
            $nmf->save();
        }

        return redirect(url('user/profile'))->with('status','Profile updated successfully.');
    }

    public function userProfileEdit()
    {
        $email=Auth::user()->email;
        $tab=MerchantInfo::where('email',$email)->first(); 
        $tab_PaymentType=PaymentType::where('module_status','Active')->get();
        $tab_WalletProvider=WalletProvider::where('module_status','Active')->get();
        $tab_BankAccountType=BankAccountType::where('module_status','Active')->get();     
        $tab_MerchantMFS=MerchantMFS::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        $tab_MerchantBankInfo=MerchantBankInfo::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        return view('admin.pages.merchantinfo.merchantinfo_edit_profile',[
            'dataRow_PaymentType'=>$tab_PaymentType,
            'wp'=>$tab_WalletProvider,
            'wp_mfs'=>$tab_MerchantMFS,
            'wp_bank'=>$tab_MerchantBankInfo,
            'bt'=>$tab_BankAccountType,
            'dataRow'=>$tab,'edit'=>true]);  
    }

    public function changePassword()
    {
        $email=Auth::user()->email;
        $tab=MerchantInfo::where('email',$email)->first(); 
        $tab_PaymentType=PaymentType::all();     
        $tab_WalletProvider=WalletProvider::all();     
        $tab_MerchantMFS=MerchantMFS::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        $tab_MerchantBankInfo=MerchantBankInfo::where('merchant_id',$tab->id)->where('module_status','Active')->first();  
        return view('admin.pages.merchantinfo.merchantinfo_change_password',[
            'dataRow_PaymentType'=>$tab_PaymentType,
            'wp'=>$tab_WalletProvider,
            'wp_mfs'=>$tab_MerchantMFS,
            'wp_bank'=>$tab_MerchantBankInfo,
            'dataRow'=>$tab,'edit'=>true]);  
    }

    public function dochangePassword(Request $request)
    {
        $this->validate($request,[
            'current_password'=>'required',
            'new_password'=>'required',
            'retype_password'=>'required',
        ]);
        $email=Auth::user()->email;
        $tab=MerchantInfo::where('email',$email)->first(); 
        $password = $tab->password;

        if($password!=$request->current_password)
        {
            return redirect(url('change/password'))->with('error','Current password mismatch.');
        }

        
        if($request->retype_password!=$request->new_password)
        {
            return redirect(url('change/password'))->with('error','New password mismatch with retype password.');
        }

        $tab->password=$request->new_password;
        $tab->save();

        \DB::table('users')->where('email',$email)->update(['password'=>\Hash::make($request->new_password)]);
        
        Auth::logout();

        return redirect(url('login'))->with('status','Password Changed successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MerchantInfo  $merchantinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MerchantInfo $merchantinfo,$id=0)
    {
        $this->validate($request,[
                
                'full_name'=>'required',
                'mobile'=>'required',
                'email'=>'required',
                'password'=>'required',
                'business_name'=>'required',
                'business_address'=>'required',
                'pickup_address'=>'required',
                'payment_method'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Merchant Info","Update","Edit / Modify");

        
        $tab_7_PaymentType=PaymentType::where('id',$request->payment_method)->first();
        $payment_method_7_PaymentType=$tab_7_PaymentType->name;
        $tab=MerchantInfo::find($id);
        
        $tab->full_name=$request->full_name;
        $tab->mobile=$request->mobile;
        $tab->email=$request->email;
        $tab->password=$request->password;
        $tab->business_name=$request->business_name;
        $tab->business_address=$request->business_address;
        $tab->pickup_address=$request->pickup_address;
        $tab->payment_method_name=$payment_method_7_PaymentType;
        $tab->payment_method=$request->payment_method;
        $tab->module_status=$request->module_status;
        $tab->save();

        $merchant_id=$tab->id;
        $pm=$request->payment_method;
        if($pm==1)
        {
            $wp=WalletProvider::find($request->wallet_provider_id);

            $countMfs=MerchantMFS::where('merchant_id',$merchant_id)->count();  
            if($countMfs>0)
            {
                MerchantMFS::where('merchant_id',$merchant_id)->delete(); 
            }

            $nmf=new MerchantMFS();
            $nmf->merchant_id=$merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->wallet_provider_id=$request->wallet_provider_id;
            $nmf->wallet_provider_id_name=$wp->name;
            $nmf->mobile_number=$request->wallet_no;
            $nmf->save();
        }
        elseif($pm==2)
        {
            $countMfs=MerchantBankInfo::where('merchant_id',$request->merchant_id)->count();  
            if($countMfs>0)
            {
                MerchantBankInfo::where('merchant_id',$request->merchant_id)->delete(); 
            }
            $wp_ac_type=BankAccountType::find($request->ac_type);
            $nmf=new MerchantBankInfo();
            $nmf->merchant_id=$merchant_id;
            $nmf->merchant_id_full_name=$request->full_name;
            $nmf->bank_name=$request->bank_name;
            $nmf->bank_branch=$request->branch;
            $nmf->account_type=$request->ac_type;
            $nmf->account_type_name=$wp_ac_type->name;
            $nmf->account_name=$request->ac_name;
            $nmf->account_number=$request->ac_no;
            $nmf->save();
        }

        return redirect('merchantinfo')->with('status','Profile Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MerchantInfo  $merchantinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantInfo $merchantinfo,$id=0)
    {
        $this->SystemAdminLog("Merchant Info","Destroy","Delete");

        $tab=MerchantInfo::find($id);
        $tab->delete();
        return redirect('merchantinfo')->with('status','Deleted Successfully !');}
}
