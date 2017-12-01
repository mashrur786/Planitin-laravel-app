<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;


class PromotionController extends Controller
{

     public function __construct()
    {

             $this->middleware('auth:partner');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('test');
    }


    public function redeem(Request $request)
    {
        $code = $request->code; 
        $restaurant_id = '';
        $customer_id = '';
        $increment = 50;

        $campaign_user = DB::table('campaign_user')
            ->where('code', $code )->first();

        if($campaign_user != null || !empty($campaign_user)){

            $restaurant_id = Campaign::findOrFail($campaign_user->campaign_id)->restaurant_id;
            $customer_id = $campaign_user->user_id;


        } else {
            Session::flash('error', 'Invalid Code');
            return redirect()->route('partner.dashboard');
        }


        //if campaign belongs to the restaurant/partner
        if($restaurant_id == Auth::guard('partner')->user()->restaurant_id){

            // redeem the code
            $redeem = DB::table('campaign_user')
            ->where('code', $code )
            ->where('redeem', 0 )
            ->update(['redeem' => 1]);

            // if successfully redeemed
             if($redeem){

                 //give points to the user
                 $points_incremented = DB::table('restaurant_user')
                     ->where('restaurant_id', $restaurant_id)
                     ->where('user_id', $customer_id)
                     ->increment('points', 50);

                 if($points_incremented){
                      //
                    Session::flash('success', 'Promotion Code Validated');
                    return redirect()->route('partner.dashboard');
                 }

            }

        }

        Session::flash('error', 'Code not valid ');
        return redirect()->route('partner.dashboard');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
