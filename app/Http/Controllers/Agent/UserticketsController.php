<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserticketsController extends Controller
{
    public function index()
    {
        return view('admin.usertickets');
    }
}
