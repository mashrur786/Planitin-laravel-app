<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirement;
use Session;
use App\Restaurant;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $requirements = Requirement::all();

        //dd($requirements);
        return view('requirements.index')->with('requirements', $requirements);
        //return view('requirements.index');
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
        $this->validate($request, array('name' => 'required|max:255'));
        $requirement = new Requirement;

        $requirement->name = $request->name;
        $requirement->save();

        $request->session()->flash('success', 'new requirement was successfully added');
        //Session::flash();

        return redirect()->route('requirements.index');
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
        $requirement = Requirement::find($id);
        //$requirement->restaurants->detach(); //works without this
        $requirement->delete();

        Session::flash('success', 'requirement deleted');


        return redirect()->route('requirements.index');
    }
}
