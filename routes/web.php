<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::get('/master', 'HomeController@master')->name('master');
Route::get('/', 'HomeController@index');
Route::post('/merchant/signup','MerchantinfoController@signup');
Route::get('/reset/password','MerchantinfoController@resetform');
Route::post('/reset/password','MerchantinfoController@sendresetLink');
Route::get('/reset/verify/{token}','MerchantinfoController@verifyresetLink');
Route::post('/reset/token/password','MerchantinfoController@doResetPass');
// Route::get('/register',function(){
//     return redirect(url('login'));
// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/crud', 'CrudController@crud')->name('crud');
    Route::post('/crud', 'CrudController@crudgenarate')->name('crudgenarate');
    Route::get('/dashboard', 'FrontServiceController@dashboard')->name('dashboard');
    Route::get('/home', 'FrontServiceController@dashboard');
    //======================== Sitesetting Route Start ===============================//
    Route::get('/sitesetting/list','SitesettingController@show');
    Route::get('/sitesetting/create','SitesettingController@create');
    Route::get('/sitesetting/edit/{id}','SitesettingController@edit');
    Route::get('/sitesetting/delete/{id}','SitesettingController@destroy');
    Route::get('/sitesetting','SitesettingController@index');
    Route::get('/sitesetting/export/excel','SitesettingController@ExportExcel');
    Route::get('/sitesetting/export/pdf','SitesettingController@ExportPDF');
    Route::post('/sitesetting','SitesettingController@store');
    Route::post('/sitesetting/ajax','SitesettingController@ajaxSave');
    Route::post('/sitesetting/datatable/ajax','SitesettingController@datatable');
    Route::post('/sitesetting/update/{id}','SitesettingController@update');
    //======================== Sitesetting Route End ===============================//
    //======================== Topmenu Route Start ===============================//
    Route::get('/topmenu/list','TopmenuController@show');
    Route::get('/topmenu/create','TopmenuController@create');
    Route::get('/topmenu/edit/{id}','TopmenuController@edit');
    Route::get('/topmenu/delete/{id}','TopmenuController@destroy');
    Route::get('/topmenu','TopmenuController@index');
    Route::get('/topmenu/export/excel','TopmenuController@ExportExcel');
    Route::get('/topmenu/export/pdf','TopmenuController@ExportPDF');
    Route::post('/topmenu','TopmenuController@store');
    Route::post('/topmenu/ajax','TopmenuController@ajaxSave');
    Route::post('/topmenu/datatable/ajax','TopmenuController@datatable');
    Route::post('/topmenu/update/{id}','TopmenuController@update');
    //======================== Topmenu Route End ===============================//
    //======================== Fottermenu Route Start ===============================//
    Route::get('/fottermenu/list','FottermenuController@show');
    Route::get('/fottermenu/create','FottermenuController@create');
    Route::get('/fottermenu/edit/{id}','FottermenuController@edit');
    Route::get('/fottermenu/delete/{id}','FottermenuController@destroy');
    Route::get('/fottermenu','FottermenuController@index');
    Route::get('/fottermenu/export/excel','FottermenuController@ExportExcel');
    Route::get('/fottermenu/export/pdf','FottermenuController@ExportPDF');
    Route::post('/fottermenu','FottermenuController@store');
    Route::post('/fottermenu/ajax','FottermenuController@ajaxSave');
    Route::post('/fottermenu/datatable/ajax','FottermenuController@datatable');
    Route::post('/fottermenu/update/{id}','FottermenuController@update');
    //======================== Fottermenu Route End ===============================//
    //======================== Slider Route Start ===============================//
    Route::get('/slider/list','SliderController@show');
    Route::get('/slider/create','SliderController@create');
    Route::get('/slider/edit/{id}','SliderController@edit');
    Route::get('/slider/delete/{id}','SliderController@destroy');
    Route::get('/slider','SliderController@index');
    Route::get('/slider/export/excel','SliderController@ExportExcel');
    Route::get('/slider/export/pdf','SliderController@ExportPDF');
    Route::post('/slider','SliderController@store');
    Route::post('/slider/ajax','SliderController@ajaxSave');
    Route::post('/slider/datatable/ajax','SliderController@datatable');
    Route::post('/slider/update/{id}','SliderController@update');
    //======================== Slider Route End ===============================//
    //======================== Dreamcontent Route Start ===============================//
    Route::get('/dreamcontent/list','DreamcontentController@show');
    Route::get('/dreamcontent/create','DreamcontentController@create');
    Route::get('/dreamcontent/edit/{id}','DreamcontentController@edit');
    Route::get('/dreamcontent/delete/{id}','DreamcontentController@destroy');
    Route::get('/dreamcontent','DreamcontentController@index');
    Route::get('/dreamcontent/export/excel','DreamcontentController@ExportExcel');
    Route::get('/dreamcontent/export/pdf','DreamcontentController@ExportPDF');
    Route::post('/dreamcontent','DreamcontentController@store');
    Route::post('/dreamcontent/ajax','DreamcontentController@ajaxSave');
    Route::post('/dreamcontent/datatable/ajax','DreamcontentController@datatable');
    Route::post('/dreamcontent/update/{id}','DreamcontentController@update');
    //======================== Dreamcontent Route End ===============================//
    //======================== Videoscontent Route Start ===============================//
    Route::get('/videoscontent/list','VideoscontentController@show');
    Route::get('/videoscontent/create','VideoscontentController@create');
    Route::get('/videoscontent/edit/{id}','VideoscontentController@edit');
    Route::get('/videoscontent/delete/{id}','VideoscontentController@destroy');
    Route::get('/videoscontent','VideoscontentController@index');
    Route::get('/videoscontent/export/excel','VideoscontentController@ExportExcel');
    Route::get('/videoscontent/export/pdf','VideoscontentController@ExportPDF');
    Route::post('/videoscontent','VideoscontentController@store');
    Route::post('/videoscontent/ajax','VideoscontentController@ajaxSave');
    Route::post('/videoscontent/datatable/ajax','VideoscontentController@datatable');
    Route::post('/videoscontent/update/{id}','VideoscontentController@update');
    //======================== Videoscontent Route End ===============================//
    //======================== Exploreshelterinfo Route Start ===============================//
    Route::get('/exploreshelterinfo/list','ExploreshelterinfoController@show');
    Route::get('/exploreshelterinfo/create','ExploreshelterinfoController@create');
    Route::get('/exploreshelterinfo/edit/{id}','ExploreshelterinfoController@edit');
    Route::get('/exploreshelterinfo/delete/{id}','ExploreshelterinfoController@destroy');
    Route::get('/exploreshelterinfo','ExploreshelterinfoController@index');
    Route::get('/exploreshelterinfo/export/excel','ExploreshelterinfoController@ExportExcel');
    Route::get('/exploreshelterinfo/export/pdf','ExploreshelterinfoController@ExportPDF');
    Route::post('/exploreshelterinfo','ExploreshelterinfoController@store');
    Route::post('/exploreshelterinfo/ajax','ExploreshelterinfoController@ajaxSave');
    Route::post('/exploreshelterinfo/datatable/ajax','ExploreshelterinfoController@datatable');
    Route::post('/exploreshelterinfo/update/{id}','ExploreshelterinfoController@update');
    //======================== Exploreshelterinfo Route End ===============================//
    //======================== Shelterphoto Route Start ===============================//
    Route::get('/shelterphoto/list','ShelterphotoController@show');
    Route::get('/shelterphoto/create','ShelterphotoController@create');
    Route::get('/shelterphoto/edit/{id}','ShelterphotoController@edit');
    Route::get('/shelterphoto/delete/{id}','ShelterphotoController@destroy');
    Route::get('/shelterphoto','ShelterphotoController@index');
    Route::get('/shelterphoto/export/excel','ShelterphotoController@ExportExcel');
    Route::get('/shelterphoto/export/pdf','ShelterphotoController@ExportPDF');
    Route::post('/shelterphoto','ShelterphotoController@store');
    Route::post('/shelterphoto/ajax','ShelterphotoController@ajaxSave');
    Route::post('/shelterphoto/datatable/ajax','ShelterphotoController@datatable');
    Route::post('/shelterphoto/update/{id}','ShelterphotoController@update');
    //======================== Shelterphoto Route End ===============================//
    //======================== Peopleandstory Route Start ===============================//
    Route::get('/peopleandstory/list','PeopleandstoryController@show');
    Route::get('/peopleandstory/create','PeopleandstoryController@create');
    Route::get('/peopleandstory/edit/{id}','PeopleandstoryController@edit');
    Route::get('/peopleandstory/delete/{id}','PeopleandstoryController@destroy');
    Route::get('/peopleandstory','PeopleandstoryController@index');
    Route::get('/peopleandstory/export/excel','PeopleandstoryController@ExportExcel');
    Route::get('/peopleandstory/export/pdf','PeopleandstoryController@ExportPDF');
    Route::post('/peopleandstory','PeopleandstoryController@store');
    Route::post('/peopleandstory/ajax','PeopleandstoryController@ajaxSave');
    Route::post('/peopleandstory/datatable/ajax','PeopleandstoryController@datatable');
    Route::post('/peopleandstory/update/{id}','PeopleandstoryController@update');
    //======================== Peopleandstory Route End ===============================//
    //======================== Peoplefeedback Route Start ===============================//
    Route::get('/peoplefeedback/list','PeoplefeedbackController@show');
    Route::get('/peoplefeedback/create','PeoplefeedbackController@create');
    Route::get('/peoplefeedback/edit/{id}','PeoplefeedbackController@edit');
    Route::get('/peoplefeedback/delete/{id}','PeoplefeedbackController@destroy');
    Route::get('/peoplefeedback','PeoplefeedbackController@index');
    Route::get('/peoplefeedback/export/excel','PeoplefeedbackController@ExportExcel');
    Route::get('/peoplefeedback/export/pdf','PeoplefeedbackController@ExportPDF');
    Route::post('/peoplefeedback','PeoplefeedbackController@store');
    Route::post('/peoplefeedback/ajax','PeoplefeedbackController@ajaxSave');
    Route::post('/peoplefeedback/datatable/ajax','PeoplefeedbackController@datatable');
    Route::post('/peoplefeedback/update/{id}','PeoplefeedbackController@update');
    //======================== Peoplefeedback Route End ===============================//
    //======================== Roominfo Route Start ===============================//
    Route::get('/roominfo/list','RoominfoController@show');
    Route::get('/roominfo/create','RoominfoController@create');
    Route::get('/roominfo/edit/{id}','RoominfoController@edit');
    Route::get('/roominfo/delete/{id}','RoominfoController@destroy');
    Route::get('/roominfo','RoominfoController@index');
    Route::get('/roominfo/export/excel','RoominfoController@ExportExcel');
    Route::get('/roominfo/export/pdf','RoominfoController@ExportPDF');
    Route::post('/roominfo','RoominfoController@store');
    Route::post('/roominfo/ajax','RoominfoController@ajaxSave');
    Route::post('/roominfo/datatable/ajax','RoominfoController@datatable');
    Route::post('/roominfo/update/{id}','RoominfoController@update');
    //======================== Roominfo Route End ===============================//
    //======================== Roomdetail Route Start ===============================//
    Route::get('/roomdetail/list','RoomdetailController@show');
    Route::get('/roomdetail/create','RoomdetailController@create');
    Route::get('/roomdetail/edit/{id}','RoomdetailController@edit');
    Route::get('/roomdetail/delete/{id}','RoomdetailController@destroy');
    Route::get('/roomdetail','RoomdetailController@index');
    Route::get('/roomdetail/export/excel','RoomdetailController@ExportExcel');
    Route::get('/roomdetail/export/pdf','RoomdetailController@ExportPDF');
    Route::post('/roomdetail','RoomdetailController@store');
    Route::post('/roomdetail/ajax','RoomdetailController@ajaxSave');
    Route::post('/roomdetail/datatable/ajax','RoomdetailController@datatable');
    Route::post('/roomdetail/update/{id}','RoomdetailController@update');
    //======================== Roomdetail Route End ===============================//
    //======================== Fotterpagecontent Route Start ===============================//
    Route::get('/fotterpagecontent/list','FotterpagecontentController@show');
    Route::get('/fotterpagecontent/create','FotterpagecontentController@create');
    Route::get('/fotterpagecontent/edit/{id}','FotterpagecontentController@edit');
    Route::get('/fotterpagecontent/delete/{id}','FotterpagecontentController@destroy');
    Route::get('/fotterpagecontent','FotterpagecontentController@index');
    Route::get('/fotterpagecontent/export/excel','FotterpagecontentController@ExportExcel');
    Route::get('/fotterpagecontent/export/pdf','FotterpagecontentController@ExportPDF');
    Route::post('/fotterpagecontent','FotterpagecontentController@store');
    Route::post('/fotterpagecontent/ajax','FotterpagecontentController@ajaxSave');
    Route::post('/fotterpagecontent/datatable/ajax','FotterpagecontentController@datatable');
    Route::post('/fotterpagecontent/update/{id}','FotterpagecontentController@update');
    //======================== Fotterpagecontent Route End ===============================//

        
    //======================== Room Route Start ===============================//
    Route::get('/room/list','RoomController@show');
    Route::get('/room/create','RoomController@create');
    Route::get('/room/edit/{id}','RoomController@edit');
    Route::get('/room/delete/{id}','RoomController@destroy');
    Route::get('/room','RoomController@index');
    Route::get('/room/export/excel','RoomController@ExportExcel');
    Route::get('/room/export/pdf','RoomController@ExportPDF');
    Route::post('/room','RoomController@store');
    Route::post('/room/ajax','RoomController@ajaxSave');
    Route::post('/room/datatable/ajax','RoomController@datatable');
    Route::post('/room/update/{id}','RoomController@update');
    //======================== Room Route End ===============================//
    //======================== Bookingrequest Route Start ===============================//
    Route::get('/payment/log','BookingrequestController@paymentLog');
    Route::get('/bookingrequest/list','BookingrequestController@show');
    Route::get('/bookingrequest/create','BookingrequestController@create');
    Route::get('/bookingrequest/edit/{id}','BookingrequestController@edit');
    Route::get('/bookingrequest/takepayment/{id}','BookingrequestController@takepayment');
    Route::get('/bookingrequest/void/{id}','BookingrequestController@voidPayment');
    Route::get('/bookingrequest/delete/{id}','BookingrequestController@destroy');
    Route::get('/bookingrequest','BookingrequestController@index');
    Route::post('/bookingrequest/capture/payment','BookingrequestController@capturePayment');
    Route::post('/rentalbooking/capture/payment','BookingrequestController@RentalBookingcapturePayment');
    Route::get('/bookingrequest/export/excel','BookingrequestController@ExportExcel');
    Route::get('/bookingrequest/export/pdf','BookingrequestController@ExportPDF');
    Route::post('/bookingrequest','BookingrequestController@store');
    Route::post('/bookingrequest/ajax','BookingrequestController@ajaxSave');
    Route::post('/bookingrequest/datatable/ajax','BookingrequestController@datatable');
    Route::post('/bookingrequest/update/{id}','BookingrequestController@update');
    //======================== Bookingrequest Route End ===============================//
    //======================== Bookingconfiguration Route Start ===============================//
    Route::get('/bookingconfiguration/list','BookingconfigurationController@show');
    Route::get('/bookingconfiguration/create','BookingconfigurationController@create');
    Route::get('/bookingconfiguration/edit/{id}','BookingconfigurationController@edit');
    Route::get('/bookingconfiguration/delete/{id}','BookingconfigurationController@destroy');
    Route::get('/bookingconfiguration','BookingconfigurationController@index');
    Route::get('/bookingconfiguration/export/excel','BookingconfigurationController@ExportExcel');
    Route::get('/bookingconfiguration/export/pdf','BookingconfigurationController@ExportPDF');
    Route::post('/bookingconfiguration','BookingconfigurationController@store');
    Route::post('/bookingconfiguration/ajax','BookingconfigurationController@ajaxSave');
    Route::post('/bookingconfiguration/datatable/ajax','BookingconfigurationController@datatable');
    Route::post('/bookingconfiguration/update/{id}','BookingconfigurationController@update');
    //======================== Bookingconfiguration Route End ===============================//

    
    //======================== Cardpointestoresetting Route Start ===============================//
    Route::get('/cardpointestoresetting/list','CardpointestoresettingController@show');
    Route::get('/cardpointestoresetting/create','CardpointestoresettingController@create');
    Route::get('/cardpointestoresetting/edit/{id}','CardpointestoresettingController@edit');
    Route::get('/cardpointestoresetting/delete/{id}','CardpointestoresettingController@destroy');
    Route::get('/cardpointestoresetting','CardpointestoresettingController@index');
    Route::get('/cardpointestoresetting/export/excel','CardpointestoresettingController@ExportExcel');
    Route::get('/cardpointestoresetting/export/pdf','CardpointestoresettingController@ExportPDF');
    Route::post('/cardpointestoresetting','CardpointestoresettingController@store');
    Route::post('/cardpointestoresetting/ajax','CardpointestoresettingController@ajaxSave');
    Route::post('/cardpointestoresetting/datatable/ajax','CardpointestoresettingController@datatable');
    Route::post('/cardpointestoresetting/update/{id}','CardpointestoresettingController@update');
    //======================== Cardpointestoresetting Route End ===============================//
    //======================== Cardpointestoresetting Route Start ===============================//
    Route::get('/cardpointestoresetting/list','CardpointestoresettingController@show');
    Route::get('/cardpointestoresetting/create','CardpointestoresettingController@create');
    Route::get('/cardpointestoresetting/edit/{id}','CardpointestoresettingController@edit');
    Route::get('/cardpointestoresetting/delete/{id}','CardpointestoresettingController@destroy');
    Route::get('/cardpointestoresetting','CardpointestoresettingController@index');
    Route::get('/cardpointestoresetting/export/excel','CardpointestoresettingController@ExportExcel');
    Route::get('/cardpointestoresetting/export/pdf','CardpointestoresettingController@ExportPDF');
    Route::post('/cardpointestoresetting','CardpointestoresettingController@store');
    Route::post('/cardpointestoresetting/ajax','CardpointestoresettingController@ajaxSave');
    Route::post('/cardpointestoresetting/datatable/ajax','CardpointestoresettingController@datatable');
    Route::post('/cardpointestoresetting/update/{id}','CardpointestoresettingController@update');
    //======================== Cardpointestoresetting Route End ===============================//

    //======================== Rentalservice Route Start ===============================//
    Route::get('/rentalservice/list','RentalserviceController@show');
    Route::get('/rentalservice/create','RentalserviceController@create');
    Route::get('/rentalservice/edit/{id}','RentalserviceController@edit');
    Route::get('/rentalservice/delete/{id}','RentalserviceController@destroy');
    Route::get('/rentalservice','RentalserviceController@index');
    Route::get('/rentalservice/export/excel','RentalserviceController@ExportExcel');
    Route::get('/rentalservice/export/pdf','RentalserviceController@ExportPDF');
    Route::post('/rentalservice','RentalserviceController@store');
    Route::post('/rentalservice/ajax','RentalserviceController@ajaxSave');
    Route::post('/rentalservice/datatable/ajax','RentalserviceController@datatable');
    Route::post('/rentalservice/update/{id}','RentalserviceController@update');
    //======================== Rentalservice Route End ===============================//

    //======================== Userrole Route Start ===============================//
    Route::get('/userrole/list','UserroleController@show');
    Route::get('/userrole/create','UserroleController@create');
    Route::get('/userrole/edit/{id}','UserroleController@edit');
    Route::get('/userrole/delete/{id}','UserroleController@destroy');
    Route::get('/userrole','UserroleController@index');
    Route::get('/userrole/export/excel','UserroleController@ExportExcel');
    Route::get('/userrole/export/pdf','UserroleController@ExportPDF');
    Route::post('/userrole','UserroleController@store');
    Route::post('/userrole/ajax','UserroleController@ajaxSave');
    Route::post('/userrole/datatable/ajax','UserroleController@datatable');
    Route::post('/userrole/update/{id}','UserroleController@update');
    //======================== Userrole Route End ===============================//
    //======================== Paymenttype Route Start ===============================//
    Route::get('/paymenttype/list','PaymenttypeController@show');
    Route::get('/paymenttype/create','PaymenttypeController@create');
    Route::get('/paymenttype/edit/{id}','PaymenttypeController@edit');
    Route::get('/paymenttype/delete/{id}','PaymenttypeController@destroy');
    Route::get('/paymenttype','PaymenttypeController@index');
    Route::get('/paymenttype/export/excel','PaymenttypeController@ExportExcel');
    Route::get('/paymenttype/export/pdf','PaymenttypeController@ExportPDF');
    Route::post('/paymenttype','PaymenttypeController@store');
    Route::post('/paymenttype/ajax','PaymenttypeController@ajaxSave');
    Route::post('/paymenttype/datatable/ajax','PaymenttypeController@datatable');
    Route::post('/paymenttype/update/{id}','PaymenttypeController@update');
    //======================== Paymenttype Route End ===============================//
    //======================== Walletprovider Route Start ===============================//
    Route::get('/walletprovider/list','WalletproviderController@show');
    Route::get('/walletprovider/create','WalletproviderController@create');
    Route::get('/walletprovider/edit/{id}','WalletproviderController@edit');
    Route::get('/walletprovider/delete/{id}','WalletproviderController@destroy');
    Route::get('/walletprovider','WalletproviderController@index');
    Route::get('/walletprovider/export/excel','WalletproviderController@ExportExcel');
    Route::get('/walletprovider/export/pdf','WalletproviderController@ExportPDF');
    Route::post('/walletprovider','WalletproviderController@store');
    Route::post('/walletprovider/ajax','WalletproviderController@ajaxSave');
    Route::post('/walletprovider/datatable/ajax','WalletproviderController@datatable');
    Route::post('/walletprovider/update/{id}','WalletproviderController@update');
    //======================== Walletprovider Route End ===============================//
    //======================== Itemtype Route Start ===============================//
    Route::get('/itemtype/list','ItemtypeController@show');
    Route::get('/itemtype/create','ItemtypeController@create');
    Route::get('/itemtype/edit/{id}','ItemtypeController@edit');
    Route::get('/itemtype/delete/{id}','ItemtypeController@destroy');
    Route::get('/itemtype','ItemtypeController@index');
    Route::get('/itemtype/export/excel','ItemtypeController@ExportExcel');
    Route::get('/itemtype/export/pdf','ItemtypeController@ExportPDF');
    Route::post('/itemtype','ItemtypeController@store');
    Route::post('/itemtype/ajax','ItemtypeController@ajaxSave');
    Route::post('/itemtype/datatable/ajax','ItemtypeController@datatable');
    Route::post('/itemtype/update/{id}','ItemtypeController@update');
    //======================== Itemtype Route End ===============================//
    //======================== Sitesetting Route Start ===============================//
    Route::get('/sitesetting/list','SitesettingController@show');
    Route::get('/sitesetting/create','SitesettingController@create');
    Route::get('/sitesetting/edit/{id}','SitesettingController@edit');
    Route::get('/sitesetting/delete/{id}','SitesettingController@destroy');
    Route::get('/sitesetting','SitesettingController@index');
    Route::get('/sitesetting/export/excel','SitesettingController@ExportExcel');
    Route::get('/sitesetting/export/pdf','SitesettingController@ExportPDF');
    Route::post('/sitesetting','SitesettingController@store');
    Route::post('/sitesetting/ajax','SitesettingController@ajaxSave');
    Route::post('/sitesetting/datatable/ajax','SitesettingController@datatable');
    Route::post('/sitesetting/update/{id}','SitesettingController@update');
    //======================== Sitesetting Route End ===============================//
    //======================== Merchantinfo Route Start ===============================//
    Route::get('/merchantinfo/list','MerchantinfoController@show');
    Route::get('/merchantinfo/create','MerchantinfoController@create');
    Route::get('/merchantinfo/edit/{id}','MerchantinfoController@edit');
    Route::get('/user/edit/profile','MerchantinfoController@userProfileEdit');
    Route::get('/user/profile','MerchantinfoController@userProfile');
    Route::post('/profile/update','MerchantinfoController@updateProfile');
    Route::get('/change/password','MerchantinfoController@changePassword');
    Route::post('/change/password','MerchantinfoController@dochangePassword');
    Route::get('/merchantinfo/delete/{id}','MerchantinfoController@destroy');
    Route::get('/merchantinfo','MerchantinfoController@index');
    Route::get('/merchantinfo/export/excel','MerchantinfoController@ExportExcel');
    Route::get('/merchantinfo/export/pdf','MerchantinfoController@ExportPDF');
    Route::post('/merchantinfo','MerchantinfoController@store');
    Route::post('/merchantinfo/ajax','MerchantinfoController@ajaxSave');
    Route::post('/merchantinfo/datatable/ajax','MerchantinfoController@datatable');
    Route::post('/merchantinfo/update/{id}','MerchantinfoController@update');
    //======================== Merchantinfo Route End ===============================//
    //======================== Merchantmfs Route Start ===============================//
    Route::get('/merchantmfs/list','MerchantmfsController@show');
    Route::get('/merchantmfs/create','MerchantmfsController@create');
    Route::get('/merchantmfs/edit/{id}','MerchantmfsController@edit');
    Route::get('/merchantmfs/delete/{id}','MerchantmfsController@destroy');
    Route::get('/merchantmfs','MerchantmfsController@index');
    Route::get('/merchantmfs/export/excel','MerchantmfsController@ExportExcel');
    Route::get('/merchantmfs/export/pdf','MerchantmfsController@ExportPDF');
    Route::post('/merchantmfs','MerchantmfsController@store');
    Route::post('/merchantmfs/ajax','MerchantmfsController@ajaxSave');
    Route::post('/merchantmfs/datatable/ajax','MerchantmfsController@datatable');
    Route::post('/merchantmfs/update/{id}','MerchantmfsController@update');
    //======================== Merchantmfs Route End ===============================//
    //======================== Merchantbankinfo Route Start ===============================//
    Route::get('/merchantbankinfo/list','MerchantbankinfoController@show');
    Route::get('/merchantbankinfo/create','MerchantbankinfoController@create');
    Route::get('/merchantbankinfo/edit/{id}','MerchantbankinfoController@edit');
    Route::get('/merchantbankinfo/delete/{id}','MerchantbankinfoController@destroy');
    Route::get('/merchantbankinfo','MerchantbankinfoController@index');
    Route::get('/merchantbankinfo/export/excel','MerchantbankinfoController@ExportExcel');
    Route::get('/merchantbankinfo/export/pdf','MerchantbankinfoController@ExportPDF');
    Route::post('/merchantbankinfo','MerchantbankinfoController@store');
    Route::post('/merchantbankinfo/ajax','MerchantbankinfoController@ajaxSave');
    Route::post('/merchantbankinfo/datatable/ajax','MerchantbankinfoController@datatable');
    Route::post('/merchantbankinfo/update/{id}','MerchantbankinfoController@update');
    //======================== Merchantbankinfo Route End ===============================//
    //======================== Sendingtype Route Start ===============================//
    Route::get('/sendingtype/list','SendingtypeController@show');
    Route::get('/sendingtype/create','SendingtypeController@create');
    Route::get('/sendingtype/edit/{id}','SendingtypeController@edit');
    Route::get('/sendingtype/delete/{id}','SendingtypeController@destroy');
    Route::get('/sendingtype','SendingtypeController@index');
    Route::get('/sendingtype/export/excel','SendingtypeController@ExportExcel');
    Route::get('/sendingtype/export/pdf','SendingtypeController@ExportPDF');
    Route::post('/sendingtype','SendingtypeController@store');
    Route::post('/sendingtype/ajax','SendingtypeController@ajaxSave');
    Route::post('/sendingtype/datatable/ajax','SendingtypeController@datatable');
    Route::post('/sendingtype/update/{id}','SendingtypeController@update');
    //======================== Sendingtype Route End ===============================//
    //======================== Bookingdeliverytype Route Start ===============================//
    Route::get('/bookingdeliverytype/list','BookingdeliverytypeController@show');
    Route::get('/bookingdeliverytype/create','BookingdeliverytypeController@create');
    Route::get('/bookingdeliverytype/edit/{id}','BookingdeliverytypeController@edit');
    Route::get('/bookingdeliverytype/delete/{id}','BookingdeliverytypeController@destroy');
    Route::get('/bookingdeliverytype','BookingdeliverytypeController@index');
    Route::get('/bookingdeliverytype/export/excel','BookingdeliverytypeController@ExportExcel');
    Route::get('/bookingdeliverytype/export/pdf','BookingdeliverytypeController@ExportPDF');
    Route::post('/bookingdeliverytype','BookingdeliverytypeController@store');
    Route::post('/bookingdeliverytype/ajax','BookingdeliverytypeController@ajaxSave');
    Route::post('/bookingdeliverytype/datatable/ajax','BookingdeliverytypeController@datatable');
    Route::post('/bookingdeliverytype/update/{id}','BookingdeliverytypeController@update');
    //======================== Bookingdeliverytype Route End ===============================//
    //======================== Bookingpackage Route Start ===============================//
    Route::get('/bookingpackage/list','BookingpackageController@show');
    Route::get('/bookingpackage/create','BookingpackageController@create');
    Route::get('/bookingpackage/edit/{id}','BookingpackageController@edit');
    Route::get('/bookingpackage/delete/{id}','BookingpackageController@destroy');
    Route::get('/bookingpackage','BookingpackageController@index');
    Route::get('/bookingpackage/export/excel','BookingpackageController@ExportExcel');
    Route::get('/bookingpackage/export/pdf','BookingpackageController@ExportPDF');
    Route::post('/bookingpackage','BookingpackageController@store');
    Route::post('/bookingpackage/ajax','BookingpackageController@ajaxSave');
    Route::post('/bookingpackage/datatable/ajax','BookingpackageController@datatable');
    Route::post('/bookingpackage/update/{id}','BookingpackageController@update');
    //======================== Bookingpackage Route End ===============================//
    //======================== City Route Start ===============================//
    Route::get('/city/list','CityController@show');
    Route::get('/city/create','CityController@create');
    Route::get('/city/edit/{id}','CityController@edit');
    Route::get('/city/delete/{id}','CityController@destroy');
    Route::get('/city','CityController@index');
    Route::get('/city/export/excel','CityController@ExportExcel');
    Route::get('/city/export/pdf','CityController@ExportPDF');
    Route::post('/city','CityController@store');
    Route::post('/city/ajax','CityController@ajaxSave');
    Route::post('/city/datatable/ajax','CityController@datatable');
    Route::post('/city/update/{id}','CityController@update');
    //======================== City Route End ===============================//
    //======================== Bookingarea Route Start ===============================//
    Route::get('/bookingarea/list','BookingareaController@show');
    Route::get('/bookingarea/create','BookingareaController@create');
    Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
    Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
    Route::get('/bookingarea','BookingareaController@index');
    Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
    Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
    Route::post('/bookingarea','BookingareaController@store');
    Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
    Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
    Route::post('/bookingarea/update/{id}','BookingareaController@update');
    //======================== Bookingarea Route End ===============================//

    //======================== Bankaccounttype Route Start ===============================//
    Route::get('/bankaccounttype/list','BankaccounttypeController@show');
    Route::get('/bankaccounttype/create','BankaccounttypeController@create');
    Route::get('/bankaccounttype/edit/{id}','BankaccounttypeController@edit');
    Route::get('/bankaccounttype/delete/{id}','BankaccounttypeController@destroy');
    Route::get('/bankaccounttype','BankaccounttypeController@index');
    Route::get('/bankaccounttype/export/excel','BankaccounttypeController@ExportExcel');
    Route::get('/bankaccounttype/export/pdf','BankaccounttypeController@ExportPDF');
    Route::post('/bankaccounttype','BankaccounttypeController@store');
    Route::post('/bankaccounttype/ajax','BankaccounttypeController@ajaxSave');
    Route::post('/bankaccounttype/datatable/ajax','BankaccounttypeController@datatable');
    Route::post('/bankaccounttype/update/{id}','BankaccounttypeController@update');
    //======================== Bankaccounttype Route End ===============================//
    //======================== Bookingorder Route Start ===============================//
    Route::get('/order/search','BookingorderController@search');
    Route::post('/order/search','BookingorderController@search');
    Route::post('/order/export/excel','BookingorderController@exportFilterExcel');
    Route::post('/order/export/pdf','BookingorderController@exportFilterPDF');
    Route::get('/bookingorder/list','BookingorderController@show');
    Route::get('/bookingorder/create','BookingorderController@create');
    Route::get('/bookingorder/edit/{id}','BookingorderController@edit');
    Route::get('/bookingorder/view/{id}','BookingorderController@view');
    Route::get('/bookingorder/delete/{id}','BookingorderController@destroy');
    Route::get('/bookingorder','BookingorderController@index');
    Route::get('/bookingorder/export/excel','BookingorderController@ExportExcel');
    Route::get('/bookingorder/export/pdf','BookingorderController@ExportPDF');
    Route::post('/bookingorder','BookingorderController@store');
    Route::post('/bookingorder/ajax','BookingorderController@ajaxSave');
    Route::post('/bookingorder/datatable/ajax','BookingorderController@datatable');
    Route::post('/bookingorder/update/{id}','BookingorderController@update');
    //======================== Bookingorder Route End ===============================//

});


//======================== Slidersetting Route Start ===============================//
Route::get('/slidersetting/list','SlidersettingController@show');
Route::get('/slidersetting/create','SlidersettingController@create');
Route::get('/slidersetting/edit/{id}','SlidersettingController@edit');
Route::get('/slidersetting/delete/{id}','SlidersettingController@destroy');
Route::get('/slidersetting','SlidersettingController@index');
Route::get('/slidersetting/export/excel','SlidersettingController@ExportExcel');
Route::get('/slidersetting/export/pdf','SlidersettingController@ExportPDF');
Route::post('/slidersetting','SlidersettingController@store');
Route::post('/slidersetting/ajax','SlidersettingController@ajaxSave');
Route::post('/slidersetting/datatable/ajax','SlidersettingController@datatable');
Route::post('/slidersetting/update/{id}','SlidersettingController@update');
//======================== Slidersetting Route End ===============================//
//======================== Bookingarea Route Start ===============================//
Route::get('/bookingarea/list','BookingareaController@show');
Route::get('/bookingarea/create','BookingareaController@create');
Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
Route::get('/bookingarea','BookingareaController@index');
Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
Route::post('/bookingarea','BookingareaController@store');
Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
Route::post('/bookingarea/update/{id}','BookingareaController@update');
//======================== Bookingarea Route End ===============================//
//======================== Bookingarea Route Start ===============================//
Route::get('/bookingarea/list','BookingareaController@show');
Route::get('/bookingarea/create','BookingareaController@create');
Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
Route::get('/bookingarea','BookingareaController@index');
Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
Route::post('/bookingarea','BookingareaController@store');
Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
Route::post('/bookingarea/update/{id}','BookingareaController@update');
//======================== Bookingarea Route End ===============================//
//======================== Bookingarea Route Start ===============================//
Route::get('/bookingarea/list','BookingareaController@show');
Route::get('/bookingarea/create','BookingareaController@create');
Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
Route::get('/bookingarea','BookingareaController@index');
Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
Route::post('/bookingarea','BookingareaController@store');
Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
Route::post('/bookingarea/update/{id}','BookingareaController@update');
//======================== Bookingarea Route End ===============================//
//======================== Bookingarea Route Start ===============================//
Route::get('/bookingarea/list','BookingareaController@show');
Route::get('/bookingarea/create','BookingareaController@create');
Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
Route::get('/bookingarea','BookingareaController@index');
Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
Route::post('/bookingarea','BookingareaController@store');
Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
Route::post('/bookingarea/update/{id}','BookingareaController@update');
//======================== Bookingarea Route End ===============================//
//======================== Bookingarea Route Start ===============================//
Route::get('/bookingarea/list','BookingareaController@show');
Route::get('/bookingarea/create','BookingareaController@create');
Route::get('/bookingarea/edit/{id}','BookingareaController@edit');
Route::get('/bookingarea/delete/{id}','BookingareaController@destroy');
Route::get('/bookingarea','BookingareaController@index');
Route::get('/bookingarea/export/excel','BookingareaController@ExportExcel');
Route::get('/bookingarea/export/pdf','BookingareaController@ExportPDF');
Route::post('/bookingarea','BookingareaController@store');
Route::post('/bookingarea/ajax','BookingareaController@ajaxSave');
Route::post('/bookingarea/datatable/ajax','BookingareaController@datatable');
Route::post('/bookingarea/update/{id}','BookingareaController@update');
//======================== Bookingarea Route End ===============================//
//======================== Paymentmethod Route Start ===============================//
Route::get('/paymentmethod/list','PaymentmethodController@show');
Route::get('/paymentmethod/create','PaymentmethodController@create');
Route::get('/paymentmethod/edit/{id}','PaymentmethodController@edit');
Route::get('/paymentmethod/delete/{id}','PaymentmethodController@destroy');
Route::get('/paymentmethod','PaymentmethodController@index');
Route::get('/paymentmethod/export/excel','PaymentmethodController@ExportExcel');
Route::get('/paymentmethod/export/pdf','PaymentmethodController@ExportPDF');
Route::post('/paymentmethod','PaymentmethodController@store');
Route::post('/paymentmethod/ajax','PaymentmethodController@ajaxSave');
Route::post('/paymentmethod/datatable/ajax','PaymentmethodController@datatable');
Route::post('/paymentmethod/update/{id}','PaymentmethodController@update');
//======================== Paymentmethod Route End ===============================//
//======================== Shippingcost Route Start ===============================//
Route::get('/shippingcost/list','ShippingcostController@show');
Route::get('/shippingcost/create','ShippingcostController@create');
Route::get('/shippingcost/edit/{id}','ShippingcostController@edit');
Route::get('/shippingcost/delete/{id}','ShippingcostController@destroy');
Route::get('/shippingcost','ShippingcostController@index');
Route::get('/shippingcost/export/excel','ShippingcostController@ExportExcel');
Route::get('/shippingcost/export/pdf','ShippingcostController@ExportPDF');
Route::post('/shippingcost','ShippingcostController@store');
Route::post('/shippingcost/ajax','ShippingcostController@ajaxSave');
Route::post('/shippingcost/datatable/ajax','ShippingcostController@datatable');
Route::post('/shippingcost/update/{id}','ShippingcostController@update');
//======================== Shippingcost Route End ===============================//
//======================== Rpaerasevoucherreport Route Start ===============================//
Route::get('/rpaerasevoucherreport/list','RpaerasevoucherreportController@show');
Route::get('/rpaerasevoucherreport/create','RpaerasevoucherreportController@create');
Route::get('/rpaerasevoucherreport/edit/{id}','RpaerasevoucherreportController@edit');
Route::get('/rpaerasevoucherreport/delete/{id}','RpaerasevoucherreportController@destroy');
Route::get('/rpaerasevoucherreport','RpaerasevoucherreportController@index');
Route::get('/rpaerasevoucherreport/export/excel','RpaerasevoucherreportController@ExportExcel');
Route::get('/rpaerasevoucherreport/export/pdf','RpaerasevoucherreportController@ExportPDF');
Route::post('/rpaerasevoucherreport','RpaerasevoucherreportController@store');
Route::post('/rpaerasevoucherreport/ajax','RpaerasevoucherreportController@ajaxSave');
Route::post('/rpaerasevoucherreport/datatable/ajax','RpaerasevoucherreportController@datatable');
Route::post('/rpaerasevoucherreport/update/{id}','RpaerasevoucherreportController@update');
//======================== Rpaerasevoucherreport Route End ===============================//