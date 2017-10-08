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

        dd($users) ;

    }

     public function code(Request $request)
    {

        $user = Auth::user();
        $campaign_id = $request->campaign_id;
        $code = '';



        if ($user->campaigns()
                         ->where('user_id', $user->id )
                        ->where('campaign_id', $campaign_id)
                        ->exists())
        {

            $code = $user->campaigns()->findOrFail($campaign_id)->pivot->code;


        } else {

            $code =  $user->id . str_random(5) . $campaign_id ;

            try {
                $user->campaigns()->attach($campaign_id, ['code' => $code]);
            } catch (\Illuminate\Database\QueryException $e) {
                return $e;
            }

        }

        return $code;


    }
}
