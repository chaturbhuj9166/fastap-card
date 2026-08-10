<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return  view('agent-new.contact.index' ,['contact'=>Contact::paginate(10)]);
    }
    public function contactview($id)
    {
       // return  view('admin.contactview' ,['contactview'=>Contact::all()]);

        $Contact = Contact::where('id',$id)->first();
        return view('agent.contactview', ['contactview' => $Contact]);
    }
}
