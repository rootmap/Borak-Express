<?php

namespace App\Http\Controllers;


use App\Http\Requests;

use App\MerchantToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\DB;

use App\User; 
use App\OrderStatusHistory;
use App\BookingOrder;
use App\ItemType;              
use App\City;      
use App\BookingArea;       
use App\BookingDeliveryType;      
use App\SendingType;      
use App\BookingPackage;
use App\PaymentMethod;
use App\ShippingCost;
use App\MerchantInfo;
//use App\OrderStatusHistory; 
use Excel;
use File;
use Session;
use Config;
use PDF;
use Response;
use Mpdf\Mpdf;
class MerchantApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $sdc;
    public function __construct()
    {
        $this->sdc = new CoreCustomController();
    }
     
    public function index()
    {

        
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
        return view('admin.pages.merchant_api.get_token',[
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_City'=>$tab_City,
            'dataRow_BookingArea'=>$tab_BookingArea,
            'dataRow_ItemType'=>$tab_ItemType,
            'dataRow_SendingType'=>$tab_SendingType,
            'dataRow_ShippingCost'=>$tab_ShippingCost,
            'dataRow_PaymentMethod'=>$tab_PaymentMethod,
            'dataRow_MerchantInfo'=>$tab_MerchantInfo,
            'dataRow_BookingDeliveryType'=>$tab_BookingDeliveryType,'dataRow_BookingPackage'=>$tab_BookingPackage,'edit'=>true]);
        

    }

    public function gettoken(){
        $tab=User::select('api_token'
                            )
                            ->where('id',$this->sdc->UserID())
                            ->get();
                            return response()->json($tab);
    }

    public function tracking(Request $request){
        $tracking_no=$request->tracking_no;
        $tab=OrderStatusHistory::select ('*')
                            ->where('order_id',$tracking_no)
                            ->orderBy('created_at','DESC')->get();
                            return response()->json($tab);
    }
    public function importexcel(Request $request){
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::selectSheetsByIndex(0)->load($path)->get(); 
            
            // foreach ($data as $row){
            //     OrderStatusHistory::create([
            //         'order_id' => $row->order_id,
            //         'parcel_status' => $row->parcel_status,
            //         'remarks' => $row->remarks,
            //         'created_by' => $row->created_by
            //     ]);
            // }
            // return redirect()->back()->with('status', count($data) . ' Data Successfully import! ');
            return $data;
        }
    }
    public function import(Request $request){
        //validate the xls file
     $this->validate($request, array(
      'file'      => 'required'
     ));
   
     if($request->hasFile('file')){
      $extension = File::extension($request->file->getClientOriginalName());
      if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
   
       $path = $request->file->getRealPath();
       $data = Excel::load($path, function($reader) {
       })->get();
      // ignoreEmpty()->skip(1)
       if(!empty($data) && $data->count()){
   
        foreach ($data as $key => $value) {
         $insert[] = [


        'sending_type_name' => $value->sending_type_name,
        'sending_type' => $value->sending_type,
        'recipient_number' => $value->recipient_number,
        'recipient_number_two' => $value->recipient_number_two,
        'recipient_name' => $value->recipient_name,
        'address' => $value->address,
        'recipient_city_name' => $value->recipient_city_name,
        'recipient_city' => $value->recipient_city,
        'recipient_area_area_name' => $value->recipient_area_area_name,
        'recipient_area' => $value->recipient_area,
        'landmarks' => $value->landmarks,
        'product_id' => $value->product_id,
        'parcel_type_name' => $value->parcel_type_name,
        'parcel_type' => $value->parcel_type,
        'delivery_type_name' => $value->delivery_type_name,
        'delivery_type' => $value->delivery_type,
        'package_id_name' => $value->package_id_name,
        'package_id' => $value->package_id,
        'product_price' => $value->product_price,
        'deliver_date' => $value->deliver_date,
        'no_of_items' => $value->no_of_items,
        'special_note' => $value->special_note,
        'parcel_status' => $value->parcel_status,
        'payment_method' => $value->payment_method,
        'payment_method_name' => $value->payment_method_name,
        'shipping_cost' => $value->shipping_cost,
        'total_charge' => $value->total_charge,
        'payment_status' => $value->payment_status,
        'created_by' => $value->order_created_by,
        //  'order_id' => $value->order_id,
        //  'parcel_status' => $value->parcel_status,
        //  'remarks' => $value->remarks,
        //  'created_by' => $value->created_by,
         ];
        }
   
        if(!empty($insert)){
   
         $insertData = DB::table('booking_orders')->insert($insert);
         if ($insertData) {
          Session::flash('success', 'Your Data has successfully imported');
         }else {                        
          Session::flash('error', 'Error inserting the data..');
          return back();
         }
        }
       }
   
       return back();
       //return $data;
   
      }else {
       Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
       return back();
      }
     }
    }
//     public function pdf($id=0)
//     {
//         // $tab=BookingOrder::find($id);
//         // var_dump($tab);
//         $html='<div class="order_pdf">
//             <table width="100%" border="0" cellspacing="0" cellpadding="10">
//             <tr>
//             <td width="50%">
//             <div style="border: 2px solid #000000;box-sizing: border-box;padding: 10px">
//              <h2>SHIP FROM :</h2>
//             <h5>Date : 8 May</h5>
//             <h5>Attire Mart</h5>
//             <p>Adress: uttara dhaka , sector- 7
//                 road -8. house -36, Uttara Dhaka-1230
//             </p>
//             <p>Phone : XXXXXXXXXX</p>
//             </div>
//         </td>
//         <td width="50%">
//             <div style="border: 2px solid #000000;box-sizing: border-box; padding: 10px">
//                 <h2>SHIP TO :</h2>
//                 <h5>Date : 10 May</h5>
//                 <h5>Ishtiaque Ahmed</h5>
//                 <p>Adress: uttara dhaka , sector- 7
//                     road -8. house -36, Uttara Dhaka-1230
//                 </p>
//                 <p>Phone : XXXXXXXXXX</p>
//             </div>
//         </td>
//     </tr>

// </table>

// <h2 align="center">INSTRUCTION: DELIVARY SHOULD DONE BY 10TH MAY</h2>
// <table width="80%" align="center" border="1" cellpadding="10" cellspacing="0">

//     <tr>
//         <td>
//             <table width="100%" cellspacing="0" cellpadding="20">
//                 <tr>
//                     <td width="50%" align="center">
//                         <h1 style="border-inline-end: 3px solid #000000;">COD</h1>
//                     </td>
//                     <td width="50%">
//                      <h1>Tk. 2,700</h1>
//                     </td>
//                 </tr>
//             </table>
//         </td>
//     </tr>
// </table>
// <table width="80%" align="center" border="0" cellpadding="20" cellspacing="0">

//     <tr>
//         <td>
//             <input type="checkbox" id="delivered" name="delivered" value="delivered">
//             <label for="delivered"> DELIVERED</label>
//         </td>
//         <td>
//             <input type="checkbox" id="cancelled" name="cancelled" value="cancelled">
//             <label for="cancelled"> CANCELLED</label>
//         </td>
//         <td>
//             <input type="checkbox" id="hold" name="hold" value="hold">
//             <label for="hold"> HOLD</label>
//         </td>
//     </tr>
// </table>

// <table width="98%" align="center" border="1" cellpadding="10" cellspacing="0">

//     <tr>
//         <td>
//             <table width="100%" cellspacing="0" cellpadding="10">
//                 <tr>
//                     <td width="50%">
//                         <h2>Borak Express</h2>
//                         <h4>Trakcing ID : 4455856</h4>
//                         <img src="'.asset("Gray/pdf_image.svg").'">
//                     </td>
//                     <td width="50%" align="center">
//                         <img src="'.asset("Gray/pdf_logo.svg").'">
//                         <p>Adress: uttara dhaka , sector- 7
//                             road -8. house -36, Uttara Dhaka-1230
//                         </p>
//                         <p>Phone : XXXXXXXXXX</p>

//                     </td>
//                 </tr>
//             </table>
//         </td>
//     </tr>
// </table>
// <p align="center">NOTED: IF LOST, PLEASE RETURN TO BORAK EXPRESS</p>
// <p align="center">Addess : 261, West Agargaon, Dhaka-1207</p>
// </div>';
//         var_dump($html);
//     }
//    public function pdf($id=0)
//    {
//        $data = ['title' => 'test'];
//        $pdf = PDF::loadView('test', $data);
//        $pdf = $pdf->stream('document.pdf');
//        return Response::make($pdf, 200, array('content-type' => 'application/pdf'));
//    }
//    public function pdf($id=0)
//    {
//        $mpdf = new \Mpdf\Mpdf();
//        $mpdf->WriteHTML($this->pdfHtml());
//
//        $mpdf->Output('filename.pdf', \Mpdf\Output\Destination::INLINE);
//    }
    public function pdfHtml()
    {
        $output = '<div class="order_pdf">
             <table width="100%" border="0" cellspacing="0" cellpadding="10">
             <tr>
             <td width="50%">
             <div style="border: 2px solid #000000;box-sizing: border-box;padding: 10px">
              <h2>SHIP FROM :</h2>
             <h5>Date : 8 May</h5>
             <h5>Attire Mart</h5>
             <p>Adress: uttara dhaka , sector- 7
                 road -8. house -36, Uttara Dhaka-1230
             </p>
             <p>Phone : XXXXXXXXXX</p>
             </div>
         </td>
         <td width="50%">
             <div style="border: 2px solid #000000;box-sizing: border-box; padding: 10px">
                 <h2>SHIP TO :</h2>
                 <h5>Date : 10 May</h5>
                 <h5>Ishtiaque Ahmed</h5>
                 <p>Adress: uttara dhaka , sector- 7
                     road -8. house -36, Uttara Dhaka-1230
                 </p>
                 <p>Phone : XXXXXXXXXX</p>
             </div>
         </td>
     </tr>

 </table>

 <h2 align="center">INSTRUCTION: DELIVARY SHOULD DONE BY 10TH MAY</h2>
 <table width="80%" align="center" border="1" cellpadding="10" cellspacing="0">

     <tr>
         <td>
             <table width="100%" cellspacing="0" cellpadding="20">
                 <tr>
                     <td width="50%" align="center">
                         <h1 style="border-inline-end: 3px solid #000000;">COD</h1>
                     </td>
                     <td width="50%">
                      <h1>Tk. 2,700</h1>
                     </td>
                 </tr>
             </table>
         </td>
     </tr>
 </table>
 <table width="80%" align="center" border="0" cellpadding="20" cellspacing="0">

     <tr>
         <td>
             <input type="checkbox" id="delivered" name="delivered" value="delivered">
             <label for="delivered"> DELIVERED</label>
         </td>
         <td>
             <input type="checkbox" id="cancelled" name="cancelled" value="cancelled">
             <label for="cancelled"> CANCELLED</label>
         </td>
         <td>
             <input type="checkbox" id="hold" name="hold" value="hold">
             <label for="hold"> HOLD</label>
         </td>
     </tr>
 </table>

 <table width="98%" align="center" border="1" cellpadding="10" cellspacing="0">

     <tr>
         <td>
             <table width="100%" cellspacing="0" cellpadding="10">
                 <tr>
                     <td width="50%">
                         <h2>Borak Express</h2>
                         <h4>Trakcing ID : 4455856</h4>
                         <img src="'.asset("Gray/pdf_image.svg").'">
                     </td>
                     <td width="50%" align="center">
                         <img src="'.asset("Gray/pdf_logo.svg").'">
                         <p>Adress: uttara dhaka , sector- 7
                             road -8. house -36, Uttara Dhaka-1230
                         </p>
                         <p>Phone : XXXXXXXXXX</p>

                     </td>
                 </tr>
             </table>
         </td>
     </tr>
 </table>
 <p align="center">NOTED: IF LOST, PLEASE RETURN TO BORAK EXPRESS</p>
 <p align="center">Addess : 261, West Agargaon, Dhaka-1207</p>
 </div>';
        return $output;
    
    }
    function pdf($id=0)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->stream();
    }
    function convert_customer_data_to_html()
    {
        $output = '
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
                                    <h5>Date : 8 May</h5>
                                    <h5>Attire Mart</h5>
                                    <p>Adress: uttara dhaka , sector- 7
                                        road -8. house -36, Uttara Dhaka-1230
                                    </p>
                                    <p>Phone : XXXXXXXXXX</p>
                                </td>
                            </tr>

                        </table>
                    </td>
                    <td width="50%">
                        <table width="100%" border="1" cellspacing="0" cellpadding="10">
                            <tr>
                                <td>
                                    <h2>SHIP TO :</h2>
                                    <h5>Date : 10 May</h5>
                                    <h5>Ishtiaque Ahmed</h5>
                                    <p>Adress: uttara dhaka , sector- 7
                                        road -8. house -36, Uttara Dhaka-1230
                                    </p>
                                    <p>Phone : XXXXXXXXXX</p>
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

            <h2 align="center">INSTRUCTION: DELIVARY SHOULD DONE BY 10TH MAY</h2>
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
                                  <h1 style="border-inline-end: 3px solid #000000;">COD</h1>
                              </td>
                              <td width="50%">
                                  <h1>Tk. 2,700</h1>
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
                        <input type="checkbox" id="delivered" name="delivered" value="delivered">
                        <label for="delivered"> DELIVERED</label>
                    </td>
                    <td>
                        <input type="checkbox" id="cancelled" name="cancelled" value="cancelled">
                        <label for="cancelled"> CANCELLED</label>
                    </td>
                    <td>
                        <input type="checkbox" id="hold" name="hold" value="hold">
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
                                    <h4>Trakcing ID : 4455856</h4>
                                    <img src="'.asset("Gray/pdf_image.svg").'">
                                </td>
                                <td width="50%" align="center">
                                    <img src="'.asset("Gray/pdf_logo.svg").'">
                                    <p>Adress: uttara dhaka , sector- 7
                                        road -8. house -36, Uttara Dhaka-1230
                                    </p>
                                    <p>Phone : XXXXXXXXXX</p>

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
            <p align="center">NOTED: IF LOST, PLEASE RETURN TO BORAK EXPRESS</p>
            <p align="center">Addess : 261, West Agargaon, Dhaka-1207</p>
        </td>
    </tr>
  </table>';
        return $output;
    }
    public function getDownload(){
        //PDF file is stored under project/public/download/info.pdf
        $file="./excel/Booking_order_template.xlsx";
        //return Response::download($file);
        $headers = array(
            'Content-Type: application/pdf',
          );

  return Response::download($file, 'filename.pdf', $headers);
  }
    


    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MerchantToken  $merchantToken
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantToken $merchantToken)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MerchantToken  $merchantToken
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantToken $merchantToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MerchantToken  $merchantToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MerchantToken $merchantToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MerchantToken  $merchantToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantToken $merchantToken)
    {
        //
    }
}
