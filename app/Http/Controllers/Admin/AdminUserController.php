<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;



class AdminUserController extends Controller
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
     * deactivate a user.
     *
     * @return void
     */
    public function deactivate($id){

            $user = User::find($id);
            $user->active = 0;
            $user->save();

             Session::flash('success', 'User has been Deactivated');
             return redirect()->route('admin.users');

    }

    /**
     * deactivate a user.
     *
     * @return void
     */
    public function activate($id){

            $user = User::find($id);
            $user->active = 1;
            $user->save();

             Session::flash('success', 'User has been Activated');
             return redirect()->route('admin.users');

    }


}
