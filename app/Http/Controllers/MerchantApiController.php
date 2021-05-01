<?php

namespace App\Http\Controllers;

use App\MerchantToken;
use Illuminate\Http\Request;

class MerchantApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.merchant_api.get_token');

    }

    /**
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
