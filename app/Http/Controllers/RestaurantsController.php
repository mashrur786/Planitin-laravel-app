<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantsController extends Controller
{
    public function welcome(){

        return view('restaurants.welcome');

    }

    public function search(Request $request, Restaurant $restaurant){

        $term =  $request->term;
        return view('restaurants.result')->with('term', $term);

    }

    public function autocompleteSearch(Request $request, Restaurant $restaurant){

        $term =   $request->input('term');
        $data = array();

        $results = $restaurant->where('business_name', 'LIKE', '%'.$term .'%')
                                ->orWhere('postcode', 'LIKE', '%'.$term.'%')
                                ->orWhere('cuisine', 'LIKE', '%'.$term.'%')
                                ->take(5)->get();

        foreach ($results as $result){

            $data[] = [ 'id' => $result->id, 'value' => $result->cuisine . ' - ' . $result->business_name . ' ' . $result->postcode];
        }

        return response()->json($data);



    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
