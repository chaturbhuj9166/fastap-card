<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Homeabout;

class HomeaboutController extends Controller
{
    public function index()
    {
        $homeabout = Homeabout::where('id',1)->first();
        return view('admin.homeabout' , ['homeabout'=> $homeabout]);
    }

    public function edit($id)
    {
        $homeabout = Homeabout::where('id',1)->first();
        return view('admin.edithomeabout' , ['homeabout'=> $homeabout]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg|max:10000',
            'title' => 'required',
            'description' =>'required',
            'internal_title1' => 'required',
            'internal_desc1' =>'required',
            'internal_title2' => 'required',
            'internal_desc2' =>'required'
        ]);

        $homeabout = Homeabout::where('id',$id)->first();

        if(isset($request->image))
        {
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('frontend/assets/images/about/home3'),$imageName);
            $homeabout->image = $imageName;
        }

        $homeabout->title = $request->title;
        $homeabout->description = $request->description;
        $homeabout->internal_title1 = $request->internal_title1;
        $homeabout->internal_desc1 = $request->internal_desc1;
        $homeabout->internal_title2 = $request->internal_title2;
        $homeabout->internal_desc2 = $request->internal_desc2;


        $homeabout->save();

        //return back()->withSuccess('Home Why Updated !!!!');
        return redirect('/admin/homeabout')->withSuccess('Home About Updated !!!!');
    }



}
