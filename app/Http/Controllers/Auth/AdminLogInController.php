<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLogInController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    //show login form
    public function showLoginForm()
    {
        return view('admins.login');
    }


    public function login(Request $request)
    {
        // validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the admin user in
        $attempt = Auth::guard('admin')->attempt([ 'email' => $request->email, 'password' => $request->password], $request->remember);

        if($attempt){
             //if successful, then redirect to the their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

            return redirect()->back()->withInput($request->only('email', 'remember'));

        //if unsuccessful, then redirect back to the login with the form data
    }


}


