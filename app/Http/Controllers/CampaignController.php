<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Campaign;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except('show');


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $campaigns = Campaign::active()->get();
        $expired_campaigns = Campaign::expired()->get();
        //dd($campaigns);


        return view('admins.campaigns.index')
        ->with(['campaigns'=> $campaigns, 'expired_campaigns' => $expired_campaigns]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('admins.campaigns.create')->with('restaurants', $restaurants);
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
        $campaign = new Campaign;
        //store a new restaurant
        //Restaurant::create($request->all());
        $campaign->restaurant_id = $request->restaurant_id ;
        $campaign->title = $request->title ;
        $campaign->description = $request->description ;
        $campaign->expires = $request->expires ;
        $campaign->save();

        //trigger NewCampaignCreated event
        event(new \App\Events\NewCampaignCreated($campaign));

        return redirect('/admin/campaigns');
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
        $campaign = Campaign::find($id);

        $route = explode('.',Route::currentRouteName());
        if(in_array('admin',$route)) {
            return view('admins.campaigns.show')->withCampaign($campaign);
        } elseif (in_array('partner',$route)){

            return view('partners.campaigns.show')->withCampaign($campaign);

        } else {
            return view('campaigns.show')->withCampaign($campaign);
        }




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
        $campaign = Campaign::find($id);
        return view('admins.campaigns.edit')->withCampaign($campaign);
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
         //
        $campaign = Campaign::find($id);
        //store a new restaurant
        //Restaurant::create($request->all());
        //$campaing->restaurant_id = $request->restaurant_id ;
        $campaign->title = $request->title ;
        $campaign->description = $request->description ;
        $campaign->expires = $request->expires ;
        $campaign->save();




        return redirect('/admin/campaigns');
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
        $campaign = Campaign::find($id);

        $campaign->users()->detach();

        $campaign->delete();

        Session::flash('success', 'Campaign deleted');


        return redirect()->route('admin.campaigns');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return return total count as int
     */
    public static function getRedeemCount($id){

        $result = DB::select( DB::raw("select COUNT(*) FROM 
                ( SELECT `redeem` as redeemed from `campaign_user` 
                Where `campaign_id`= :id And redeem = 1 )
                totalRedeemed "), ['id' => $id]);

        $redeemsCount = json_decode(json_encode($result), true) ;

        return $redeemsCount[0]["COUNT(*)"];

    }


}
