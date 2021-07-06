<?php

namespace App\Http\Controllers;
use App\BookingArea;
use App\BookingDeliveryType;
use App\BookingPackage;
use App\City;
use App\ItemType;
use App\MerchantInfo;
use App\PaymentMethod;
use App\SendingType;
use App\ShippingCost;
use Response;


class PublicBookingorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function orderBookingInfo(){
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
    return view('public.bookingorder_bulk_upload',[
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
public function orderBookingTracking(){

    return view('public.bookingorder_tracking');
}
}
