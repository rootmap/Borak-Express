<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\BookingOrder;
use App\AdminLog;
use App\ItemType;              
use App\City;      
use App\BookingArea;       
use App\BookingDeliveryType;      
use App\SendingType;      
use App\BookingPackage;
use App\PaymentMethod;
use App\ShippingCost;
use App\MerchantInfo;

class BookingorderrestController extends Controller
{
    private $moduleName="Booking Order From API";
    

    public function create(Request $request)
    {
        $payLoad = $request->all();



        $this->validate($request,[

            'api_token'=>'required',
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

        $merchant_details = MerchantInfo::WHERE("api_token",$request->api_token)->first();
        if($merchant_details->id) {
            //$order_created_by=$this->sdc->UserID();

            $parcel_status = "Pending";
            $payment_status = "";


            //$this->SystemAdminLog("Booking Order Create From API","Save New","Create New");

            //$tab_SendingType=SendingType::all();
            $tab_0_ItemType = SendingType::where('id', $request->sending_type)->first();
            $sending_type_0_ItemType = $tab_0_ItemType->name;

            $tab_0_PaymentMethod = PaymentMethod::where('id', $request->payment_method)->first();
            $PaymentMethod_name = $tab_0_PaymentMethod->name;

            $tab_4_City = City::where('id', $request->recipient_city)->first();
            $recipient_city_4_City = $tab_4_City->name;
            $tab_5_BookingArea = BookingArea::where('id', $request->recipient_area)->first();
            $recipient_area_5_BookingArea = $tab_5_BookingArea->area_name;
            $tab_8_ItemType = ItemType::where('id', $request->parcel_type)->first();
            $parcel_type_8_ItemType = $tab_8_ItemType->name;
            $tab_9_BookingDeliveryType = BookingDeliveryType::where('id', $request->delivery_type)->first();
            $delivery_type_9_BookingDeliveryType = $tab_9_BookingDeliveryType->name;
            $tab_10_BookingPackage = BookingPackage::where('id', $request->package_id)->first();
            $package_id_10_BookingPackage = $tab_10_BookingPackage->name;

            $tab = new BookingOrder();
            $tab->sending_type_name = $sending_type_0_ItemType;
            $tab->sending_type = $request->sending_type;
            $tab->recipient_number = $request->recipient_number;
            $tab->recipient_number_two = $request->recipient_number_two;
            $tab->recipient_name = $request->recipient_name;
            $tab->address = $request->address;
            $tab->recipient_city_name = $recipient_city_4_City;
            $tab->recipient_city = $request->recipient_city;
            $tab->recipient_area_area_name = $recipient_area_5_BookingArea;
            $tab->recipient_area = $request->recipient_area;
            $tab->landmarks = $request->landmarks;
            $tab->product_id = $request->product_id;
            $tab->parcel_type_name = $parcel_type_8_ItemType;
            $tab->parcel_type = $request->parcel_type;
            $tab->delivery_type_name = $delivery_type_9_BookingDeliveryType;
            $tab->delivery_type = $request->delivery_type;
            $tab->package_id_name = $package_id_10_BookingPackage;
            $tab->package_id = $request->package_id;
            $tab->product_price = $request->product_price;
            $tab->deliver_date = $request->deliver_date;
            $tab->no_of_items = $request->no_of_items;
            $tab->special_note = $request->special_note;
            $tab->parcel_status = $parcel_status;
            $tab->payment_method = $request->payment_method;
            $tab->payment_method_name = $PaymentMethod_name;
            $tab->shipping_cost = $request->shipping_cost;
            $tab->total_charge = $request->total_charge;
            $tab->payment_status = $payment_status;
            $tab->created_by = $merchant_details->id;
            $tab->save();

            //Session::put('booking_id',$tab->id);

            $response['success'] = true;
            $response['data'] = 'Order added successfully';
        }
        else {
            $response['success'] = false;
            $response['data'] = 'Invalid API Token';
        }
            return response()->json($response);

}
}

