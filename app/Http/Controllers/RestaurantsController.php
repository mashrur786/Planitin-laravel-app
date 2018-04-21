<?php

namespace App\Http\Controllers;

use App\Events\NewRestaurant;
use App\Requirement;
use Illuminate\Http\Request;
use App\Restaurant;
use Session;
use Symfony\Component\VarDumper\Dumper\DataDumperInterface;
use Illuminate\Support\Facades\Log;
use Postcode;
use Auth;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class RestaurantsController extends Controller
{
    public function welcome(){

        return view('restaurants.welcome');

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
        $requirements = Requirement::all();
        if($this->isAdminRequest()){

            return view('admins.restaurants.index')->withRestaurants($restaurants);

        } else {
            return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines,  'types' => $types, 'requirements' => $requirements ]);
        }

    }

    public function search(Request $request, Restaurant $restaurant){

        //$cuisines = $restaurant->select('cuisine')->groupBy('cuisine')->get();
        $cuisines = $restaurant->select('cuisine', DB::raw('count(*) as total'))
             ->groupBy('cuisine')
             ->pluck('total','cuisine')->all();
        $res_type = $restaurant->select('type')->groupBy('type')->get();
        $requirements = Requirement::all();

        //set Regex for uk postcode
        $regex = '/^(?:gir(?: *0aa)?|[a-pr-uwyz](?:[a-hk-y]?[0-9]+|[0-9][a-hjkstuw]|[a-hk-y][0-9][abehmnprv-y])(?: *[0-9][abd-hjlnp-uw-z]{2})?)$/';

        //get user location & restaurant type
        $location =  $request->location;
        $type = $request->res_type;

        //check if the location given is a postcode
        if(preg_match($regex, strtolower($location))){

           //the the postcode and get nearest postcode within within 3 miles radius.
            $data = Postcode::wardsByOutcode($location);

            if ($data) {

                //get outcodes of all the nearest postcodes
                $postcodes = [];
                foreach($data->result as $postcode){
                     $postcodes[] = $postcode->outcode;

                }

                //
                $restaurants = $restaurant->whereIn('outcode', $postcodes)
                                            ->Where('type', '=' , $type)
                                            ->get();

            } else {


                return redirect()->back()->withInput(Input::all())->withErrors(['please provide a valid postcode']);

            }




        } elseif (!empty($location) || $location != ''){
            
            $restaurants = $restaurant->Where('area', '=', strtolower($location))
                                        ->Where('type', '=' , $type)
                                        ->get();

        } else {

            $restaurants = $restaurant->Where('type', '=' , $type)
                                        ->get();

        };

        return view('restaurants.index',[ 'data' => $restaurants, 'cuisines' =>  $cuisines, 'types' => $res_type, 'requirements' => $requirements ]);
       // dd($restaurants_info);

    }

    /* returns */
    public function sortById(Request $request, Restaurant $restaurant){

        $id = $request->id;

        $result = $restaurant->where("restaurants.id", $id)->with('ratings')
                        ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                        ->select(array('restaurants.*',
		                DB::raw('AVG(rating) as ratings_average')))
	                    ->get();
            //Log::info($result);

            return response()->json($result);

    }

    /* Return a sorted result made via ajax */
    public function sort(Request $request, Restaurant $restaurant){

        $filters = $request->filters;
        //Log::info($request->filters);
        if(empty($filters)){

               $results = $restaurant->with('ratings')
                   ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                   ->select(array('restaurants.*',
                   DB::raw('AVG(rating) as ratings_average')))
                   ->groupBy('id')
                   ->orderBy('business_name')
                   ->get();
                   //Log::info($results);
               return $results;
        }

        $cuisines = [];
        $types = [];
        $requirements = [];

        foreach($filters as $filter){

            if($filter["filterName"] == "cuisine"){

                $cuisines[] = $filter["filterValue"];

            } elseif($filter["filterName"] == "type") {

                $types[] = $filter["filterValue"];

            } else {
                $requirements[] = $filter["filterValue"];
            }

        }

        /*$test = $restaurant::with('requirements')->get();*/

      /*  $test2 = $restaurant::whereHas('requirements', function($query) use($requirements) {
        $query->whereIn('requirements.name', ['Halal']);
        })->whereIn("cuisine", ['Indian'])->get();*/

        /*$test3 = $restaurant::whereHas('requirements', function($query) use($requirements) {
                            $query->whereIn('requirements.name', ['Halal']);
                            })->whereIn("cuisine", ['Indian'])
                            ->with('ratings')
                            ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                            ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                            ->get();*/

        /*$test3 = $restaurant->whereIn("cuisine", ['Burger'])
                            ->whereIn("type", ['restaurant'])
                            ->with('ratings')
                            ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                            ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                            ->get();*/

        //Log::info($test3);
        //return $test3;


        //only restaurant types selected
       if(empty($types) && !empty($cuisines) && !empty($requirements)){

             $results = $restaurant::whereHas('requirements', function($query) use($requirements) {
                        $query->whereIn('requirements.name', $requirements);
                        })->whereIn("cuisine", $cuisines)
                 ->with('ratings')
                 ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                 ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                 ->groupBy('id')
                 ->get();

             return $results;

            //only restaurant types selected and requirements selected
        } elseif (empty($cuisines) && !empty($types) && !empty($requirements)) {

             $results = $restaurant::whereHas('requirements', function($query) use($requirements) {
                        $query->whereIn('requirements.name', $requirements);
                        })->whereIn("type", $types)
                        ->with('ratings')
                        ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                        ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
	                    ->groupBy('id')
	                    ->get();

             return $results;

             //only restaurant types selected and cuisines selected
         } elseif (empty($requirements) && !empty($types) && !empty($cuisines)) {

               $results = $restaurant->whereIn("cuisine", $cuisines)
                   ->whereIn("type", $types)
                   ->orderBy("cuisine", "asc")
                   ->with('ratings')
                   ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                   ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                   ->groupBy('id')
                   ->get();


                return $results;

           // only cuisine selected
       } elseif (empty($types) && empty($requirements)  && !empty($cuisines)) {

               $results = $restaurant->whereIn("cuisine", $cuisines)->with('ratings')
                   ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                   ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                    ->groupBy('id')
                    ->get();
                return $results;

                // only restaurant types selected
       } elseif (empty($cuisines) && empty($requirements) && !empty($types)) {

             $results = $restaurant->whereIn("type", $types)->with('ratings')
               ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
               ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
	            ->groupBy('id')
	            ->get();
             return $results;

       } elseif (empty($cuisines) && empty($types) && !empty($requirements)) {

         $results = $restaurant::whereHas('requirements', function($query) use($requirements) {
                        $query->whereIn('requirements.name', $requirements);
                        })->with('ratings')
                        ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                        ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
                        ->groupBy('id')
                        ->get();


         return $results;

        } else {

            $results = $restaurant::whereHas('requirements', function($query) use($requirements) {
                            $query->whereIn('requirements.name', $requirements);
                            })->whereIn("cuisine", $cuisines)
                              ->whereIn("type", $types)->with('ratings')
                              ->leftJoin('ratings', 'ratings.ratingable_id', '=', 'restaurants.id')
                              ->select(array('restaurants.*', DB::raw('AVG(rating) as ratings_average')))
	                          ->groupBy('id')
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

    /* Auto-complete search at welcome screen */
    public function autocompleteSearch(Request $request, Restaurant $restaurant){

        //$resName =   $request->resName;
        $resName =    $request->term;
        //Log::info('restaurant_name_ajax: '. $resName);

        $data = array();

        $results = $restaurant->where('business_name', 'LIKE', '%'.  $resName  . '%')->take(5)->get();

        foreach ($results as $result) {

            $data[] = [ 'id' => $result->id, 'value' => $result->business_name ];
        }

        return response()->json($data);


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

        return view('admins.restaurants.create')->withRequirements($requirements);
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
        $restaurant->capstone = $request->capstone;
        $restaurant->promotion_text = $request->promotion_text;
        /* image store*/

        if($request->hasFile('f_img')){
            //code
            $image = $request->file('f_img');
            $filename = 'res_' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/restaurant_imgs/' . $filename);
            Image::make($image)->resize(800,600)->save($location);

            $restaurant->featured_img = $filename;
        }

        $restaurant->business_phone1 = $request->business_phone1;
        $restaurant->business_phone2 = $request->business_phone2;
        $restaurant->address = $request->address;
        $restaurant->street = $request->street;
        $restaurant->area = $request->area;
        $restaurant->town = $request->town;
        $restaurant->county = $request->county;
        $restaurant->outcode = $request->outcode;
        $restaurant->incode = $request->incode;
        $restaurant->website = $request->website;
        $restaurant->contact_name = $request->contact_name;
        $restaurant->contact_phone = $request->contact_phone;

        $restaurant->save();

        $requirements = ($request->requirements ?: []);
        $restaurant->requirements()->sync($requirements, false);

        // fire new restaurant created event
        event(new NewRestaurant($restaurant));
        return redirect('admin/restaurants');
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
        if($this->isAdminRequest()){
            return view('admins.restaurants.show', ['restaurant' => Restaurant::findOrFail($id)]);
        }
        return view('restaurants.show', ['restaurant' => Restaurant::findOrFail($id)]);


    }

    /**
     * Subscribe a authenticated user to specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function subscribe($id){
        //
        $user = Auth::user();

        $restaurant = Restaurant::find($id);


        if($user->restaurants()->count() < 7){

            try {
                $restaurant->users()->attach($user->id);
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error', 'You are already subscribed');
                return redirect('/home');
            }

            Session::flash('success', 'You are now subscribed');

            return redirect('/home');

        }

        Session::flash('error', 'Oops! You have reached maximum number of subscriotion');

        return redirect('/home');


    }

      /**
     * unSubscribe a authenticated user for specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe($id){
        //
        $user = Auth::user();

        $restaurant = Restaurant::find($id);
        $restaurant->users()->detach($user->id);


         Session::flash('success', 'You are now unsubscribed');

         return redirect('/home');


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
         return view('admins.restaurants.edit', ['restaurant' => Restaurant::findOrFail($id)]);
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
         $restaurant = Restaurant::findorfail($id);
        //store a new restaurant
        //Restaurant::create($request->all());
        $restaurant->email = $request->email;
        $restaurant->business_name = $request->business_name;
        $restaurant->type = $request->type;
        $restaurant->cuisine = $request->cuisine;
        $restaurant->description = $request->description;
        $restaurant->capstone = $request->capstone;
        $restaurant->promotion_text = $request->promotion_text;
        /* image store*/

        if($request->hasFile('f_img')){
            //code
            $image = $request->file('f_img');
            $filename = 'res_' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/restaurant_imgs/' . $filename);
            Image::make($image)->resize(800,700, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save($location);

            $oldfilename = $restaurant->featured_img;

            Storage::delete($oldfilename);

            $restaurant->featured_img = $filename;
        }

        $restaurant->business_phone1 = $request->business_phone1;
        $restaurant->business_phone2 = $request->business_phone2;
        $restaurant->address = $request->address;
        $restaurant->street = $request->street;
        $restaurant->area = $request->area;
        $restaurant->town = $request->town;
        $restaurant->county = $request->county;
        $restaurant->outcode = $request->outcode;
        $restaurant->incode = $request->incode;
        $restaurant->website = $request->website;
        $restaurant->contact_name = $request->contact_name;
        $restaurant->contact_phone = $request->contact_phone;

        $restaurant->save();

        $requirements = ($request->requirements ?: []);

        //delete all requirements
        $restaurant->requirements()->detach();
        // sync all teh requirements
        $restaurant->requirements()->sync($requirements, false);

        //update partner account email
        if($restaurant->partner()->exists()){
            $restaurant->partner->email = $request->email;
            $restaurant->partner->update();
        }

        return redirect('admin/restaurants');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $restaurant = Restaurant::findOrFail($id);
        //detach
        $restaurant->requirements()->detach();
        $restaurant->users()->detach();
        $restaurant->partner()->delete();

        // detach all the compaing related to the restaurant

        foreach($restaurant->campaigns as  $campaign){
            $campaign->users()->detach();
        }
        $restaurant->campaigns()->delete();

        if($restaurant->delete()){
            Session::flash('success', 'Restaurant deleted');
            return redirect()->route('admin.restaurants');
        }

        Session::flash('error', 'Restaurant counld\'t be deleted');

    }

    /**
     * Rate a given restaurant.
     *
     * @param  Request object
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        //
        $restaurant = Restaurant::find($request->restaurant_id);
        $user = Auth::user();
        $rating = $restaurant->rating([
                    'rating' => $request->rating
                ], $user);

        return $rating;

    }
}
