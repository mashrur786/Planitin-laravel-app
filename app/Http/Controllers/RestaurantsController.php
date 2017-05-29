<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;

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
                                   ->where('type', '=' , $type)
                                   ->get();

        $cuisines = $restaurant->select('cuisine')->groupBy('cuisine')->get();
        $res_type = $restaurant->select('type')->groupBy('type')->get();


        return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines, 'types' => $res_type ]);
       // dd($restaurants_info);

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

        $res_name =   $request->resName;

        $data = array();

        $results = $restaurant->where('business_name', 'LIKE', '%'.  $res_name  . '%')->take(5)->get();

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

        return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines ]);


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
