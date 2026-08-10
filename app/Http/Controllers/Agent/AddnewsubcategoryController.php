<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class AddnewsubcategoryController extends Controller
{
    public function index()
    {
        // return view('admin.addnewsubcategory');

        return view('admin.addnewsubcategory' , ['allcategory'=> Category::all()] );

    }
}
