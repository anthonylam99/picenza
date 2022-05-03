<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request){
        return view('contact.index');
    }

    /**
     * Post submit contact
     *
     * @param ContactRequest $request
     * @return void
     */
    public function postContact(ContactRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        \Session::flash('contact-success', 'Phản hồi thành công'); 

        return redirect()->route('index');
    }
}
