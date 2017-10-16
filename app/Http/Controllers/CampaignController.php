<?php

namespace App\Http\Controllers;
use App\Restaurant;
use App\Campaign;
use Illuminate\Http\Request;
use Session;

class CampaignController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
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
        $campaing = new Campaign;
        //store a new restaurant
        //Restaurant::create($request->all());
        $campaing->restaurant_id = $request->restaurant_id ;
        $campaing->title = $request->title ;
        $campaing->description = $request->description ;
        $campaing->expires = $request->expires ;

        $campaing->save();


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

        return view('admins.campaigns.show')->withCampaign($campaign);
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
        $campaing = Campaign::find($id);
        //store a new restaurant
        //Restaurant::create($request->all());
        //$campaing->restaurant_id = $request->restaurant_id ;
        $campaing->title = $request->title ;
        $campaing->description = $request->description ;
        $campaing->expires = $request->expires ;

        $campaing->save();


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

        $campaign->delete();

        Session::flash('success', 'Campaign deleted');


        return redirect()->route('admin.campaigns');

    }


}
