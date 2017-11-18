<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{

    //
    public function index(){

        $users = User::all();

        return view('admins.users.index')->withUsers($users);

    }


    /**
     *  This code generates a unique code for authenticated user
     *
     * @param  Object Request
     * @return ajax record
     */
     public function code(Request $request)
    {

        $user = Auth::user();
        $campaign_id = $request->campaign_id;
        $code = '';


        // Check if the code already exits for a given campaign
        if ($user->campaigns()
                         ->where('user_id', $user->id )
                        ->where('campaign_id', $campaign_id)
                        ->exists())
        {

            $code = $user->campaigns()->findOrFail($campaign_id)->pivot->code;


        } else {


            $code =  $campaign_id . str_random(6) ;


            try {
                $user->campaigns()->attach($campaign_id, ['code' => $code]);
            } catch (\Illuminate\Database\QueryException $e) {
                return $e;
            }

        }

        return $code;


    }


    public function show($id){

        $user = User::find($id);
        return view('admins.users.show')->withUser($user);
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
        $user = User::find($id);

        if(Auth::user() == $user )
            return view('users.edit');

        return redirect('/');

    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email,'.$user->id,
            'password' => 'required|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return view('home');
    }


        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        function markNotificationsAsRead(){
            Auth::user()->unreadNotifications->markAsRead();
        }
}
