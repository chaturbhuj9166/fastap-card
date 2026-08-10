<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        return view('agent-new.faq.index' ,['faq'=> Faq::paginate(5) ]);
    }
    public function addfaq()
    {
        return view('agent-new.faq.add');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        //return;

        // validate data
        $request->validate([
            'internal_title' => 'required',
            'internal_description' => 'required'
        ]);

        // upload image

        $faq = new Faq;
        $faq->internal_title = $request->internal_title;
        $faq->internal_description = $request->internal_description;

        $faq->save();

        return redirect('/agent/faq')->withSuccess('FAQ Created !!!!');

    }
    public function destroy($id)
    {
        $faq = Faq::where('id',$id)->first();
        $faq->delete();

        return back()->withSuccess('FAQ Deleted !!!!');
    }
    public function editfaq($id)
    {
        $faq = Faq::where('id',$id)->first();
        return view('agent.editfaq' , ['faq'=> $faq]);
    }
    public function update(Request $request, $id)
    {
         //dd($request->all());

        //return;
        // validate data
        $request->validate([
            'internal_title' => 'required',
            'internal_description' => 'required'
        ]);
        $faq = Faq::where('id',$id)->first();

        $faq->internal_title = $request->internal_title;
        $faq->internal_description = $request->internal_description;

        $faq->save();

        return redirect('/agent/faq')->withSuccess('FAQ Updated !!!!');
    }

}
