<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BankAccountType;
use App\WalletProvider;
use App\SiteSetting;
use App\SliderSetting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $WalletProvider=WalletProvider::where('module_status','Active')->get();
        $BankAccountType=BankAccountType::where('module_status','Active')->get();
        $SiteSetting=SiteSetting::orderBy('id','DESC')->first();
        $SliderSetting=SliderSetting::orderBy('id','DESC')->first();
        return view('site.pages.index',['slider'=>$SliderSetting,'wp'=>$WalletProvider,'bt'=>$BankAccountType,'site'=>$SiteSetting]);
    }

    public function master()
    {
        return view('site.layout.master');
    }
}
