<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.home');
    }

    /**
     * Show the all admins in a list.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.manage-admins.create');
    }

    /**
     * Show the all admins in a list.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role = 'manager';
        $admin->password = $request->password;

        $admin->save();

        Session::flash('success', 'New Admin User created');
        return redirect()->route('admin.admins');

    }


      /**
     * Show the all admins in a list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $admins = Admin::all();
        return view('admins.manage-admins.index')->withAdmins($admins);

    }
     /**
     * Show .
     *
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
         $admin = Admin::find($id);

        $admin->delete();

        Session::flash('success', 'Admin User deleted');


        return redirect()->route('admin.admins');

    }

}
