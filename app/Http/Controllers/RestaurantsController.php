<?php

namespace App\Http\Controllers;

use App\Requirement;
use Illuminate\Http\Request;
use App\Restaurant;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Illuminate\Support\Facades\Log;


class RestaurantsController extends Controller
{
    public function welcome(){

        return view('restaurants.welcome');

    }

    public function search(Request $request, Restaurant $restaurant){

       //dd($request);

        $location =  $request->location;
        $type = $request->res_type;


        $restaurants = $restaurant->where('postcode', '=',  $location)
                                   ->orWhere('area', '=', $location)
                                   ->orWhere('type', '=' , $type)
                                   ->get();

        $cuisines = $restaurant->select('cuisine')->groupBy('cuisine')->get();
        $res_type = $restaurant->select('type')->groupBy('type')->get();


        return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines, 'types' => $res_type ]);
       // dd($restaurants_info);

    }

    /* returns */
    public function sortById(Request $request, Restaurant $restaurant){

        $id = $request->id;

        $result = $restaurant->where("id", $id)->firstOrFail();

        return $result;


    }

    /* Return a sorted result made via ajax */
    public function sort(Request $request, Restaurant $restaurant){

        $filters = $request->filters;

        if(empty($filters)){

               $results = $restaurant->all();

               return $results;
        }

        $cuisines = [];
        $types = [];

        foreach($filters as $filter){

            if($filter["filterName"] == "cuisine"){

                $cuisines[] = $filter["filterValue"];

            } else {
                $types[] = $filter["filterValue"];

            }

        }

       if(empty($types)){

             $results = $restaurant->whereIn("cuisine", $cuisines)
                                    ->orderBy("cuisine", "asc")
                                    ->get();

             return $results;

        } elseif (empty($cuisines)) {

             $results = $restaurant->whereIn("type", $types)
                                    ->orderBy("cuisine", "asc")
                                   ->get();

             return $results;

        } else {

            $results = $restaurant->whereIn("cuisine", $cuisines)
                                  ->whereIn("type", $types)
                                  ->orderBy("cuisine", "asc")
                                  ->get();

            return $results;

        }

        //$results = DB::select($query);

        /*
       $results = $restaurant->whereIn("cuisine", $cuisines)
                               ->whereIn("type", $types)
                                ->orderBy("business_name", "asc")
                                ->toSql();*/

    }


    /* Autocomplete search at welcome screen */
    public function autocompleteSearch(Request $request, Restaurant $restaurant){


        //$resName =   $request->resName;
        $resName =    $request->term;
        //log::info('restaurant_name_ajax: '. $request);

        $data = array();

        $results = $restaurant->where('business_name', 'LIKE', '%'.  $resName  . '%')->take(5)->get();

        foreach ($results as $result) {

            $data[] = [ 'id' => $result->id, 'value' => $result->business_name ];
        }

        return response()->json($data);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Restaurant $restaurant)
    {

        $restaurants =  $restaurant->all();

        $cuisines = $restaurant->select('cuisine')->groupBy('cuisine')->get();
        $types = $restaurant->select('type')->groupBy('type')->get();

        return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines,  'types' => $types ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //add a new restaurant
        $requirements = Requirement::all();

        return view('restaurants.add')->withRequirements($requirements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = new Restaurant;
        //store a new restaurant
        //Restaurant::create($request->all());
        $restaurant->email = $request->email;
        $restaurant->business_name = $request->business_name;
        $restaurant->type = $request->type;
        $restaurant->cuisine = $request->cuisine;
        $restaurant->description = $request->description;
        $restaurant->business_phone1 = $request->business_phone1;
        $restaurant->business_phone2 = $request->business_phone2;
        $restaurant->address = $request->address;
        $restaurant->street = $request->street;
        $restaurant->area = $request->area;
        $restaurant->town = $request->town;
        $restaurant->county = $request->county;
        $restaurant->postcode = $request->postcode;
        $restaurant->website = $request->website;
        $restaurant->contact_name = $request->contact_name;
        $restaurant->contact_phone = $request->contact_phone;

        $restaurant->save();
        
        $restaurant->requirements()->sync($request->requirements, false);

        return redirect('/restaurants');
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
