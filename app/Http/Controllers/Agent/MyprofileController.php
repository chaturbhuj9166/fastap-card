<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Agent;

use Session;

class MyprofileController extends Controller
{
    public function index()
    {
        $id = Session::get('AGENT_ID');
        $agent = Agent::where('id',$id)->first();
        return view('agent-new.profile.index' , ['agent'=> $agent]);
    }

}
