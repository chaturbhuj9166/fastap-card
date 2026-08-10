<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomebannerController extends Controller
{
    public function index()
    {
        //return "I am Home banner";
        return view('admin.homebanner');
    }
}
