<?php

namespace App\Http\Controllers;

use App\SliderSetting;
use App\AdminLog;
use Illuminate\Http\Request;

class SliderSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Slider Setting";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SliderSetting::count();
        if($tabCount==0)
        {
            return redirect(url('slidersetting/create'));
        }else{

            $tab=SliderSetting::orderBy('id','DESC')->first();      
        return view('admin.pages.slidersetting.slidersetting_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SliderSetting::count();
        if($tabCount==0)
        {            
        return view('admin.pages.slidersetting.slidersetting_create');
            
        }else{

            $tab=SliderSetting::orderBy('id','DESC')->first();      
        return view('admin.pages.slidersetting.slidersetting_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
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
                
                'slider_image'=>'required',
                'water_mark'=>'required',
                'heading'=>'required',
                'detail'=>'required',
        ]);

        $this->SystemAdminLog("Slider Setting","Save New","Create New");

        

        $filename_slidersetting_0='';
        if ($request->hasFile('slider_image')) {
            $img_slidersetting = $request->file('slider_image');
            $upload_slidersetting = 'upload/slidersetting';
            $filename_slidersetting_0 = env('APP_NAME').'_'.time() . '.' . $img_slidersetting->getClientOriginalExtension();
            $img_slidersetting->move($upload_slidersetting, $filename_slidersetting_0);
        }

                
        $tab=new SliderSetting();
        
        $tab->slider_image=$filename_slidersetting_0;
        $tab->water_mark=$request->water_mark;
        $tab->heading=$request->heading;
        $tab->detail=$request->detail;
        $tab->save();

        return redirect('slidersetting')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'slider_image'=>'required',
                'water_mark'=>'required',
                'heading'=>'required',
                'detail'=>'required',
        ]);

        $tab=new SliderSetting();
        
        $tab->slider_image=$filename_slidersetting_0;
        $tab->water_mark=$request->water_mark;
        $tab->heading=$request->heading;
        $tab->detail=$request->detail;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SliderSetting  $slidersetting
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('slider_image','LIKE','%'.$search.'%');
                            $query->orWhere('water_mark','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('detail','LIKE','%'.$search.'%');
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
                            $query->orWhere('slider_image','LIKE','%'.$search.'%');
                            $query->orWhere('water_mark','LIKE','%'.$search.'%');
                            $query->orWhere('heading','LIKE','%'.$search.'%');
                            $query->orWhere('detail','LIKE','%'.$search.'%');
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

    
    public function SliderSettingQuery($request)
    {
        $SliderSetting_data=SliderSetting::orderBy('id','DESC')->get();

        return $SliderSetting_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Slider Image','Water Mark','Heading','Detail','Created Date');
        array_push($data, $array_column);
        $inv=$this->SliderSettingQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->slider_image,$voi->water_mark,$voi->heading,$voi->detail,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Slider Setting Report',
            'report_title'=>'Slider Setting Report',
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
                            <th class='text-center' style='font-size:12px;' >Slider Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Water Mark</th>
                        
                            <th class='text-center' style='font-size:12px;' >Heading</th>
                        
                            <th class='text-center' style='font-size:12px;' >Detail</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SliderSettingQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->slider_image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->water_mark."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->heading."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->detail."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Slider Setting Report',$html);


    }
    public function show(SliderSetting $slidersetting)
    {
        
        $tab=SliderSetting::all();return view('admin.pages.slidersetting.slidersetting_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SliderSetting  $slidersetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderSetting $slidersetting,$id=0)
    {
        $tab=SliderSetting::find($id);      
        return view('admin.pages.slidersetting.slidersetting_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SliderSetting  $slidersetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderSetting $slidersetting,$id=0)
    {
        $this->validate($request,[
                
                'water_mark'=>'required',
                'heading'=>'required',
                'detail'=>'required',
        ]);

        $this->SystemAdminLog("Slider Setting","Update","Edit / Modify");

        

        $filename_slidersetting_0=$request->ex_slider_image;
        if ($request->hasFile('slider_image')) {
            $img_slidersetting = $request->file('slider_image');
            $upload_slidersetting = 'upload/slidersetting';
            $filename_slidersetting_0 = env('APP_NAME').'_'.time() . '.' . $img_slidersetting->getClientOriginalExtension();
            $img_slidersetting->move($upload_slidersetting, $filename_slidersetting_0);
        }

                
        $tab=SliderSetting::find($id);
        
        $tab->slider_image=$filename_slidersetting_0;
        $tab->water_mark=$request->water_mark;
        $tab->heading=$request->heading;
        $tab->detail=$request->detail;
        $tab->save();

        return redirect('slidersetting')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SliderSetting  $slidersetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SliderSetting $slidersetting,$id=0)
    {
        $this->SystemAdminLog("Slider Setting","Destroy","Delete");

        $tab=SliderSetting::find($id);
        $tab->delete();
        return redirect('slidersetting')->with('status','Deleted Successfully !');}
}
