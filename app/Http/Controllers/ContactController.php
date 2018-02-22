<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactEmail;
use Session;
use Mail;

class ContactController extends Controller
{
     public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $contact = [];

        $contact['name'] = $request->get('name');
        $contact['email'] = $request->get('email');
        $contact['telephone'] = $request->get('telephone');
        $contact['subject'] = $request->get('subject');
        $contact['message'] = $request->get('message');

        // Mail delivery logic goes here
        Mail::to('mashru_uk@hotmail.com')->send(new ContactEmail($contact));

        Session::flash('success', 'Thank you for contacting planitin. We will get back to you soon');

        return redirect()->route('contact.create');
    }

}
