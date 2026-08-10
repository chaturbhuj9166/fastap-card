<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Homewhy;

class HomewhyController extends Controller
{
    public function index()
    {
        $homewhy = Homewhy::where('id',1)->first();
        return view('admin.homewhy' , ['homewhy'=> $homewhy]);
    }
    public function edit($id)
    {
        $homewhy = Homewhy::where('id',1)->first();
        return view('admin.edithomewhy' , ['homewhy'=> $homewhy]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'image' => 'nullable|mimes:jpeg,jpg|max:10000',
            'video_link' =>'required',
            'title' => 'required',
            'description' =>'required',
            'skillbar_title1' => 'required',
            'skillbar_percent1' =>'required',
            'skillbar_title2' => 'required',
            'skillbar_percent2' =>'required',
            'skillbar_title3' => 'required',
            'skillbar_percent3' =>'required',
            'skillbar_title4' => 'required',
            'skillbar_percent4' => 'required'
        ]);

        $homewhy = Homewhy::where('id',$id)->first();

        if(isset($request->image))
        {
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('frontend\assets\images\video'),$imageName);
            $homewhy->image = $imageName;
        }

        $homewhy->video_link = $request->video_link;
        $homewhy->title = $request->title;
        $homewhy->description = $request->description;

        $homewhy->skillbar_title1 = $request->skillbar_title1;
        $homewhy->skillbar_percent1 = $request->skillbar_percent1;
        $homewhy->skillbar_title2 = $request->skillbar_title2;
        $homewhy->skillbar_percent2 = $request->skillbar_percent2;
        $homewhy->skillbar_title3 = $request->skillbar_title3;
        $homewhy->skillbar_percent3 = $request->skillbar_percent3;
        $homewhy->skillbar_title4 = $request->skillbar_title4;
        $homewhy->skillbar_percent4 = $request->skillbar_percent4;

        $homewhy->save();

        //return back()->withSuccess('Home Why Updated !!!!');
        return redirect('/admin/homewhy')->withSuccess('Home Why Updated !!!!');
    }

}
