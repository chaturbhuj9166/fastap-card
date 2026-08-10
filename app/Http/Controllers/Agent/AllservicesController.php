<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;

use App\Models\Category;

use App\Models\Sub_category;


class AllservicesController extends Controller
{
    public function index()
    {
        return view('admin.allservices' ,['service'=> Service::paginate(10) , 'allcategory'=> Category::all() , 'allsubcategory'=> Sub_category::all()]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'category_id' =>'required|not_in:select',
            'sub_category_id' => 'required|not_in:select_sub',
            'service_name' => 'required',
            'service_slug' => 'required',
            'market_price' => 'required',
            'total_price' => 'required',
            'total_profit' => 'required',
            'internal_desc' => 'required',
            'step1' =>'required',
            'step2' => 'required',
            'step3' => 'required',
            'description' => 'required',
            'document_require' => 'required'
        ]);

        $service = new Service;
        $service->category_id = $request->category_id;
        $service->sub_category_id = $request->sub_category_id;
        $service->service_name = $request->service_name;
        $service->service_slug = $request->service_slug;
        $service->market_price = $request->market_price;
        $service->total_price = $request->total_price;
        $service->total_profit = $request->total_profit;
        $service->internal_desc = $request->internal_desc;
        $service->step1 = $request->step1;
        $service->step2 = $request->step2;
        $service->step3 = $request->step3;
        $service->description = $request->description;
        $service->document_require = $request->document_require;

        $service->save();
        return redirect('/admin/allservices')->withSuccess('Service Created !!!!');

    }

    public function destroy($id)
    {
        $service = Service::where('id',$id)->first();
        $service->delete();

        return back()->withSuccess('Service Deleted !!!!');
    }

    public function editservice($id)
    {
        $service = Service::where('id',$id)->first();
        return view('admin.editservice' ,['service'=> $service , 'allcategory'=> Category::all() , 'allsubcategory'=> Sub_category::all()]);
    }

    public function update(Request $request ,$id)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'category_id' =>'required|not_in:select',
            'sub_category_id' => 'required|not_in:select_sub',
            'service_name' => 'required',
            'service_slug' => 'required',
            'market_price' => 'required',
            'total_price' => 'required',
            'total_profit' => 'required',
            'internal_desc' => 'required',
            'step1' =>'required',
            'step2' => 'required',
            'step3' => 'required',
            'description' => 'required',
            'document_require' => 'required'
        ]);

        $service = Service::where('id',$id)->first();

        $service->category_id = $request->category_id;
        $service->sub_category_id = $request->sub_category_id;
        $service->service_name = $request->service_name;
        $service->service_slug = $request->service_slug;
        $service->market_price = $request->market_price;
        $service->total_price = $request->total_price;
        $service->total_profit = $request->total_profit;
        $service->internal_desc = $request->internal_desc;
        $service->step1 = $request->step1;
        $service->step2 = $request->step2;
        $service->step3 = $request->step3;
        $service->description = $request->description;
        $service->document_require = $request->document_require;

        $service->save();
        return redirect('/admin/allservices')->withSuccess('Service Updated !!!!');

    }

}
