<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AddnewuserController extends Controller
{
    public function index()
    {
        $last_interaction = User::latest()->orderBy('id', 'desc')->skip(0)->take(5)->get(); //get first 5 rows

        return view('agent-new.user.add' , ['last_interaction' => $last_interaction]);

    }
}
