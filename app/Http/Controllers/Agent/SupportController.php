<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\Models\Manager;

use App\Models\Agent;

class SupportController extends Controller
{
    public function index()
    {
        $id= session()->get('AGENT_ID');
        $agent = Agent::where('id',$id)->first();
        return view('agent-new.support.index' , ['agent'=> $agent]);

    }


}
